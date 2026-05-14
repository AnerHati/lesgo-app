<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\StudyClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use App\Enums\TransactionStatus;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config("midtrans.server_key");
        Config::$isProduction = config("midtrans.is_production");
        Config::$isSanitized = config("midtrans.is_sanitized");
        Config::$is3ds = config("midtrans.is_3ds");
    }

    public function createSnapToken(Request $request, $transactionId)
    {
        $transaction = Transaction::with("studyClass.student", "studyClass.subject")
            ->findOrFail($transactionId);

        if ($transaction->studyClass->student_id !== Auth::id()) {
            Log::warning("Unauthorized payment attempt", [
                'user_id' => Auth::id(),
                'transaction_id' => $transactionId,
                'ip' => $request->ip()
            ]);
            abort(403);
        }

        $params = [
            "transaction_details" => [
                "order_id" => "LESGO-" . $transaction->id . "-" . time(),
                "gross_amount" => (int) $transaction->amount,
            ],
            "customer_details" => [
                "first_name" => $transaction->studyClass->student->name,
                "email" => $transaction->studyClass->student->email,
            ],
            "item_details" => [
                [
                    "id" => $transaction->studyClass->id,
                    "price" => (int) $transaction->amount,
                    "quantity" => 1,
                    "name" => "Kelas " . ($transaction->studyClass->subject->name ?? "Belajar"),
                ],
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            "snap_token" => $snapToken,
            "client_key" => config("midtrans.client_key"),
        ]);
    }

    public function handleWebhook(Request $request)
    {
        $serverKey = config("midtrans.server_key");
        $hashed = hash("sha512",
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if ($hashed !== $request->signature_key) {
            return response()->json(["message" => "Invalid signature"], 403);
        }

        $parts = explode("-", $request->order_id);
        $transactionId = $parts[1] ?? null;

        if (!$transactionId) {
            return response()->json(["message" => "Invalid order ID"], 400);
        }

        $transaction = Transaction::find($transactionId);
        if (!$transaction) {
            return response()->json(["message" => "Transaction not found"], 404);
        }

        if ($transaction->status === TransactionStatus::PAID) {
            return response()->json(["message" => "Transaction already processed"], 200);
        }

        $status = $request->transaction_status;

        if ($status === "capture" || $status === "settlement") {
            $transaction->update([
                "status" => TransactionStatus::PAID,
                "payment_method" => $request->payment_type,
                "paid_at" => now(),
            ]);

            \Illuminate\Support\Facades\Cache::forget("student.dashboard." . $transaction->studyClass->student_id);
            \Illuminate\Support\Facades\Cache::forget("tutor.stats." . $transaction->studyClass->tutor_id);

            Log::info("Transaction Paid Successfully", [
                'transaction_id' => $transaction->id,
                'study_class_id' => $transaction->study_class_id,
                'amount' => $transaction->amount,
                'payment_method' => $request->payment_type,
                'ip' => $request->ip(),
                'order_id' => $request->order_id
            ]);

        } elseif (in_array($status, ["deny", "expire", "cancel"])) {
            $transaction->update(["status" => TransactionStatus::FAILED]);
            \Illuminate\Support\Facades\Cache::forget("student.dashboard." . $transaction->studyClass->student_id);
            Log::info("Transaction Payment Failed", [
                'transaction_id' => $transaction->id,
                'status' => $status,
                'ip' => $request->ip()
            ]);
        }

        return response()->json(["message" => "OK"]);
    }
}

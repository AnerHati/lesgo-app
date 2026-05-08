<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\StudyClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    // Buat Snap Token untuk pembayaran
    public function createSnapToken(Request $request, $transactionId)
    {
        $transaction = Transaction::with('studyClass.student', 'studyClass.subject')
            ->findOrFail($transactionId);

        // Pastikan yang bayar adalah siswa pemilik kelas
        if ($transaction->studyClass->student_id !== Auth::id()) {
            abort(403);
        }

        $params = [
            'transaction_details' => [
                'order_id' => 'LESGO-' . $transaction->id . '-' . time(),
                'gross_amount' => (int) $transaction->amount,
            ],
            'customer_details' => [
                'first_name' => $transaction->studyClass->student->name,
                'email' => $transaction->studyClass->student->email,
            ],
            'item_details' => [
                [
                    'id' => $transaction->studyClass->id,
                    'price' => (int) $transaction->amount,
                    'quantity' => 1,
                    'name' => 'Kelas ' . ($transaction->studyClass->subject->name ?? 'Belajar'),
                ],
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'snap_token' => $snapToken,
            'client_key' => config('midtrans.client_key'),
        ]);
    }

    // Webhook dari Midtrans (callback otomatis)
    public function handleWebhook(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        // Verifikasi signature
        if ($hashed !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Ambil transaction ID dari order_id (format: LESGO-{id}-{timestamp})
        $parts = explode('-', $request->order_id);
        $transactionId = $parts[1] ?? null;

        if (!$transactionId) {
            return response()->json(['message' => 'Invalid order ID'], 400);
        }

        $transaction = Transaction::find($transactionId);
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        // Update status berdasarkan callback Midtrans
        $status = $request->transaction_status;

        if ($status === 'capture' || $status === 'settlement') {
            $transaction->update([
                'status' => 'paid',
                'payment_method' => $request->payment_type,
                'paid_at' => now(),
            ]);
        } elseif (in_array($status, ['deny', 'expire', 'cancel'])) {
            $transaction->update(['status' => 'failed']);
        }

        return response()->json(['message' => 'OK']);
    }
}

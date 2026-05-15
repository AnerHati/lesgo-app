<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Http\Controllers\RefundController as BaseRefundController;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    /**
     * Setujui refund (Hanya Admin).
     */
    public function approve(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        
        try {
            BaseRefundController::approveRefund($transaction);
            return response()->json(['message' => 'Refund berhasil disetujui.']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    /**
     * Tolak refund (Hanya Admin).
     */
    public function reject(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        
        try {
            BaseRefundController::rejectRefund($transaction);
            return response()->json(['message' => 'Refund ditolak.']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}

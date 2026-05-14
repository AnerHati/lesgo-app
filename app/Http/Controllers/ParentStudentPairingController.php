<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParentStudentPairingController extends Controller
{
    /**
     * Generate pairing token for the authenticated student.
     */
    public function generateToken(Request $request)
    {
        $user = Auth::user();

        if ($user->active_role !== 'siswa') {
            return response()->json(['message' => 'Hanya siswa yang dapat membuat kode pairing.'], 403);
        }

        $token = $user->generatePairingToken();

        return response()->json([
            'token' => $token,
            'expires_at' => $user->pairing_token_expires_at->toIso8601String(),
        ]);
    }

    /**
     * Get the current pairing token for the authenticated student if it's still valid.
     */
    public function getToken(Request $request)
    {
        $user = Auth::user();

        if ($user->active_role !== 'siswa') {
            return response()->json(['message' => 'Hanya siswa yang dapat memiliki kode pairing.'], 403);
        }

        if (!$user->pairing_token || $user->pairing_token_expires_at->isPast()) {
            return response()->json(['token' => null]);
        }

        return response()->json([
            'token' => $user->pairing_token,
            'expires_at' => $user->pairing_token_expires_at->toIso8601String(),
        ]);
    }

    /**
     * Pair the authenticated parent with a student using a token.
     */
    public function pair(Request $request)
    {
        $request->validate([
            'token' => 'required|string|size:6',
            'relationship' => 'required|string|max:50',
        ]);

        $user = Auth::user();

        // Standardize role check
        if ($user->active_role !== 'orangtua') {
            return response()->json(['message' => 'Hanya orang tua yang dapat menautkan akun anak.'], 403);
        }

        $success = $user->pairWithStudent($request->token, $request->relationship);

        if (!$success) {
            return response()->json(['message' => 'Kode pairing tidak valid atau sudah kedaluwarsa.'], 422);
        }

        return response()->json(['message' => 'Berhasil menautkan akun anak!']);
    }

    /**
     * List all children linked to the authenticated parent.
     */
    public function getChildren()
    {
        $user = Auth::user();

        if ($user->active_role !== 'orangtua') {
            return response()->json(['message' => 'Hanya orang tua yang dapat melihat daftar anak.'], 403);
        }

        $children = $user->children()->with(['studentProfile'])->get();

        return response()->json(['children' => $children]);
    }
}

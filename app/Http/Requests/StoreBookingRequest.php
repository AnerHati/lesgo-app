<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreBookingRequest extends FormRequest
{
    /**
     * Tentukan siapa yang boleh melakukan request ini.
     */
    public function authorize(): bool
    {
        // Hanya user yang sedang login (siswa) yang boleh membuat booking
        return Auth::check();
    }

    /**
     * Dapatkan aturan validasinya.
     */
    public function rules(): array
    {
        // Aturan ini saya ambil (copy-paste) dari StudentDashboardController Anda
        return [
            'tutor_id'             => 'required|exists:users,id',
            'subject_id'           => 'required|exists:subjects,id',
            'metode_belajar'       => 'required|string|in:rumah,online',
            'paket_mengajar'       => 'required|string|exists:packages,slug',
            'preferred_start_time' => 'nullable|string|max:255',
        ];
    }
}

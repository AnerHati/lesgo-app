<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreNoteRequest extends FormRequest
{
    public function authorize(): bool {
        return Auth::check() && Auth::user()->hasRole('tutor');
    }

    public function rules(): array {
        return [
            'content' => 'required|string',
        ];
    }
}

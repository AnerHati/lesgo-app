<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreMaterialRequest extends FormRequest
{
    public function authorize(): bool {
        return Auth::check() && Auth::user()->hasRole('tutor');
    }

    public function rules(): array {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }
}

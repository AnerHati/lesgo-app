<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreScheduleRequest extends FormRequest
{
    public function authorize(): bool {
        return Auth::check() && Auth::user()->hasRole('tutor');
    }

    public function rules(): array {
        return [
            'study_class_id' => 'required|exists:study_classes,id',
            'start_time'     => 'required|date',
            'end_time'       => 'required|date|after:start_time',
        ];
    }
}

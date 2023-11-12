<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'report_id' => 'required|exists:reports,id',
            'user_id' => 'required|exists:users,id',
            'program' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'form' => 'required|string|max:255',
            'course' => 'nullable|integer',
            'avg_score' => 'nullable|numeric',
            'KCP' => 'nullable|integer',
            'students_all' => 'nullable|integer',
            'students_federal' => 'nullable|integer',
            'students_subject' => 'nullable|integer',
            'students_target' => 'nullable|integer',
            'students_paid' => 'nullable|integer',
            'students_foreigner' => 'nullable|integer',
            'students_orphan' => 'nullable|integer',
            'students_without_care' => 'nullable|integer',
            'need' => 'nullable|integer',
            'provided' => 'nullable|integer',
            'refused' => 'nullable|integer',
            'release' => 'nullable|integer',
            'GIA' => 'nullable|integer',
            'interim_certification' => 'nullable|integer',
            'basic_level' => 'nullable|integer',
            'professional_level' => 'nullable|integer',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json(["errors" => $validator->errors()], 422));
    }
}

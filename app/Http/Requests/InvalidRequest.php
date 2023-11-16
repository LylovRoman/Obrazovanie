<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class InvalidRequest extends FormRequest
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
            'profession' => 'required|string|max:255',
            'students_federal' => 'nullable|integer',
            'students_subject' => 'nullable|integer',
            'students_target' => 'nullable|integer',
            'students_paid' => 'nullable|integer',
            'OVZ' => 'nullable|integer',
            'invalids' => 'nullable|integer',

            'vision_reception' => 'nullable|integer',
            'vision_quantity' => 'nullable|integer',
            'vision_release' => 'nullable|integer',

            'hearing_reception' => 'nullable|integer',
            'hearing_quantity' => 'nullable|integer',
            'hearing_release' => 'nullable|integer',

            'musculoskeletal_reception' => 'nullable|integer',
            'musculoskeletal_quantity' => 'nullable|integer',
            'musculoskeletal_release' => 'nullable|integer',

            'other_reception' => 'nullable|integer',
            'other_quantity' => 'nullable|integer',
            'other_release' => 'nullable|integer',

            'hard_reception' => 'nullable|integer',
            'hard_quantity' => 'nullable|integer',
            'hard_release' => 'nullable|integer',

            'intelligence_reception' => 'nullable|integer',
            'intelligence_quantity' => 'nullable|integer',
            'intelligence_release' => 'nullable|integer',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json(["errors" => $validator->errors()], 422));
    }
}

<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            'login' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'role' => 'required|string|in:user,admin',
            'password' => 'required|string|min:6|confirmed'
        ];
    }

    //переопределяю метод, чтобы выбросить ошибку в JSON
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json(["errors" => $validator->errors()], 422));
    }
}

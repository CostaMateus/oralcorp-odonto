<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "token"    => "required",
            "email"    => "required|email|exists:users,email",
            "password" => "required|min:8|confirmed",
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "password.required" => "Informe uma senha",
            "password.min"      => "A senha deve ter no mínimo 8 dígitos",
        ];
    }
}

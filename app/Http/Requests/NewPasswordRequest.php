<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPasswordRequest extends FormRequest
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

            "external_id"           => "required|string",
            "clinic_id"             => "required|string",
            "email"                 => "required|string",
            "phone"                 => "nullable|string",
            "name"                  => "required|string",
            "password"              => "required|min:8",
            "password_confirmation" => "required|min:8|same:password",
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
            "password.required"              => "Informe uma senha",
            "password.min"                   => "A senha deve ter no mínimo 8 dígitos",

            "password_confirmation.required" => "Informe a confirmação de senha",
            "password_confirmation.min"      => "A senha deve ter no mínimo 8 dígitos",
            "password_confirmation.same"     => "A confirmação de senha deve ser idêntica a senha",
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalEasyRequest extends FormRequest
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
            "clinic_id" => "bail|required|string",
            "email"     => "bail|required|email|string",
            "password"  => "bail|required|string",
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
            "clinic_id.required" => "Selecione uma unidade",
            "clinic_id.string"   => "Selecione uma unidade",

            "email.required"    => "Informe um e-mail",
            "email.email"       => "Informe um e-mail válido",
            "email.string"      => "Informe um e-mail",

            "password.required" => "Informe uma senha",
            "password.string"   => "Informe uma senha",
        ];
    }
}

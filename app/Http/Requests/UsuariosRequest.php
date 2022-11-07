<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuariosRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'tipo' => 'required',
            'nombre' => 'required',
            'correo' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ];
    }

    public function attributes()
    {
        return[
            'tipo' => 'Tipo',
            'nombre' => 'Nombre',
            'correo' => 'Correo Electronico',
            'password1' => 'Password',
            'password2' => 'Confirmar Password',
        ];
    }
}

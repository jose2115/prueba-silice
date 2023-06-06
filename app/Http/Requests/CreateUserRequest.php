<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateUserRequest extends FormRequest
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
            'name'        => 'required|max:16',
            'full_name'   => 'required|max:128',
            'email'       => 'required|max:128|email:rfc,dns|unique:users,email,' . Auth::user()->id,
            'password'    => ['required', 'string', 'min:8', 'confirmed'],
            'nif'         => 'required|max:12',
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
            'name.required'  => 'el usuario es requerido',
            'name.max'       => 'el  maximo de caracteres es de 16',
            'full_name'      => 'Nombre es requerido',
            'full_name.max'  => 'el maximo de caracteres es de 128',
            'email.required' => 'el correo es requerido',
            'email.unique'   => 'el correo ya pertenece a otro usuario',
            'email.email'    => 'el correo no es un correo electrónico válido',
            'password.min'   => 'debe tener minimo 8 caracteres',
            'password.confirmed' => 'las contraseñas deben ser iguales',
            'nif.max'        => 'el nif debe contener máximo 12 caracteres',
        ];
    }
}

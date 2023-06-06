<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
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
            'name'        => 'required',
            'email'       => 'required|email:rfc,dns|unique:users,email,' . Auth::user()->id,
            'nif'       => 'max:12',
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
            'name.required'  => 'el nombre es requerido',
            'email.required' => 'el correo es requerido',
            'email.unique'   => 'el correo ya pertenece a otro usuario',
            'email.email'    => 'el correo no es un correo electrónico válido',
            'nif.max'        => 'el nif debe contener máximo 12 caracteres',
        ];
    }
}

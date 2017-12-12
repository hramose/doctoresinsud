<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserEditFormRequest extends Request
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
            //nombre requerido
            'name' => 'required',
            //email requerido
            'email' => 'required',
            //password debe ser alfanumerico, minimo 6 caracteres y confirmada (escrita 2 veces iguales)
            'password' => 'alpha_num|min:6|confirmed',
            //password_confirmation debe ser alfanumerico, minimo 6 caracteres
            'password_confirmation' => 'alpha_num|min:6'
        ];
    }
}
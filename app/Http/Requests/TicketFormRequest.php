<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TicketFormRequest extends Request
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
            //Title es requerido y minimo 3 caracteres
            'title' => 'required|min:3',
            //Content es requerido y minimo 10 caracteres
            'content' => 'required|min:10',
        ];
    }
}
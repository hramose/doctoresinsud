<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ConsultaFormRequest extends Request
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

    public function messages()
    {
        return [
            'titulo.required' => 'El campo Titulo de la consulta es requerido',
            'descripcion.required' => 'El campo Descripción de la consulta es requerido',
        ];
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'titulo' => 'required',
            'descripcion' => 'required',
        ];
    }
}

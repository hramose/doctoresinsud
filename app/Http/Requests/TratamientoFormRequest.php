<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TratamientoFormRequest extends Request
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

    public function messages()
    {
        return [
            'droga.required' => 'El campo Droga es requerido',
            'droga.min' => 'El campo Droga requiere al menos 3 caracteres',
            'flia_droga.required' => 'El campo Familia Droga es requerido',
            'flia_droga.max' => 'El campo Familia Droga debe tener como máximo 3 caracteres',
            'dosis.numeric' => 'El campo Dosis solo acepta valores numéricos',
            'dosis.required' => 'El campo Dosis es requerido',
            'fecha_trat.date_format' => 'El campo Fecha debe tener formato DD/MM/AAAA. Revise que no contenga espacios adelante o atrás',
            'fecha_trat.required' => 'El campo fecha es requerido',
        ];
    }

    public function rules()
    {
        return [
            //Nombre requerido y mínimo 3
            'droga' => 'required|min:3',
            'dosis' => 'numeric|required',
            'flia_droga' => 'required|max:3',
            'fecha_trat' => 'required|date_format:d/m/Y',
        ];

    }
}

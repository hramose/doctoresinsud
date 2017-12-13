<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TelefonosFormRequest extends Request
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
            'etiqueta.required' => 'El campo Etiqueta es requerido',
            'telefono.required' => 'El campo Teléfono es requerido',
            'telefono.regex' => 'El formato del teléfono no es válido. Formato válido: Números separados por guión, punto o espacio. Puede empezar con + o 00 opcionalmente.',
            'activo.unique' => 'No puede haber más de un teléfono activo para el paciente. Por favor, revise los teléfonos del paciente y deje solo uno como activo.'
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
            //Valida datos de dirección
            'etiqueta' => 'required',
            'telefono' => ['regex:/^(\+|00)?(\d[\s-\.]?)*+$/','required'],
            'activo' => 'unique:telefonos,activo,NULL,id,id_paciente,'.$this->get('id_paciente'),
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DireccionesFormRequest extends Request
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
            'calle.required' => 'El campo Calle es requerido',
            'localidad.required' => 'El campo Localidad es requerido',
            'provincia.required' => 'El campo Provincia es requerido',
            'pais.required' => 'El campo País es requerido',
            'activo.unique' => 'No puede haber más de una dirección activa para el paciente. Por favor, revise las direcciones del paciente y deje solo una como activa.'
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
            'calle' => 'required',
            'localidad' => 'required',
            'provincia' => 'required',
            'pais' => 'required',
            'activo' => 'unique:direcciones,activo,NULL,id,id_paciente,'.$this->get('id_paciente'),
        ];
    }
}

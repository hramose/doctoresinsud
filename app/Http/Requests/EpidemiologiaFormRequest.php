<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EpidemiologiaFormRequest extends Request
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
            'sexo.in' => 'El campo sexo debe ser Femenino o Masculino.',
            'sexo.required' => 'El campo sexo es requerido.',
            'antefam_descrip.max' => 'El campo "Descripción antecedentes" puede tener como máximo :max caracteres',
            'estado_civil.required' => 'El campo Estado Civil es requerido',
            'estado_civil.in' => 'El campo Estado Civil debe ser alguno de estos valores: Soltero, Casado, Concuvino, Viudo, Divorsiado o Desconocido(?)',
            'localidad_nac.required' => 'El campo Localidad del Lugar de Nacimiento es requerido',
            'localidad_nac.alpha' => 'El campo Localidad del Lugar de Nacimiento solo admite letras',
            'provincia_nac.required' => 'El campo Provincia del Lugar de Nacimiento es requerido',
            'provincia_nac.alpha' => 'El campo Provincia del Lugar de Nacimiento solo admite letras',
            'pais_nac.required' => 'El campo País del Lugar de Nacimiento es requerido',
            'pais_nac.alpha' => 'El campo País del Lugar de Nacimiento solo admite letras',
            'motivo_det_chagas.max' => 'El campo ¿Motivo por el cual detectan Chagas? puede tener como máximo :max caracteres',
            'fecha_det_chagas.date_format' => 'El campo Fecha de detección de Chagas debe tener formato DD/MM/AAAA',
            'fecha_cuando_volvio_ende.date_format' => 'El campo ¿Cuándo volvió a área endémica? debe tener formato DD/MM/AAAA',
            'fecha_det_chagas.before' => 'El campo Fecha de detección de Chagas debe ser menor o igual a hoy',
            'fecha_cuando_volvio_ende.before' => 'El campo ¿Cuándo volvió a área endémica? debe ser menor o igual a hoy',
        ];
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //dd(date("jS F, Y",strtotime("+1 day")));
        return [
            //Valida datos
            'sexo' => 'in:F,M|required',
            'estado_civil' => 'in:S,C,J,V,D,?|required',
            'antefam_descrip' => 'max:20',
            'localidad_nac' => 'required|alpha',
            'provincia_nac' => 'required|alpha',
            'pais_nac' => 'required|alpha',
            'motivo_det_chagas' => 'max:30',
            'fecha_det_chagas' => 'date_format:"d/m/Y"|before:today +1 day',
            'fecha_cuando_volvio_ende' => 'date_format:"d/m/Y"|before:today +1 day'
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class editHistoriaRequest extends Request
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

    //Mensajes de error personalizados
    public function messages()
    {
        return [
            'tipo_doc.required' => 'El tipo de documento es requerido',
            'tipo_doc.alpha' => 'El tipo de documento solo acepta caracteres',
            'numero_doc.numeric' => 'El número de documento solo acepta números',
            'numero_doc.required' => 'El número de documento es requerido',
            'fecha_nac.required' => 'La fecha de nacimiento es requerida',
            'fecha_nac.date_format' => 'La fecha de nacimiento debe tener formato DD/MM/AAAA. Revise que no contenga espacios adelante o atrás.',
            'edad_ing.between' => 'La edad al ingreso debe ser un valor entre 1 y 130',
            'fecha_alta.required' => 'La fecha de alta es requerida',
            'fecha_alta.date_format' => 'La fecha de alta debe tener formato DD/MM/AAAA. Revise que no contenga espacios adelante o atrás.',
            'anios_seg.between' => 'El campo "años de seguimiento" debe ser un valor entre 1 y 130',
            'fecha_ult_consulta.date_format' => 'La fecha de última consulta debe tener formato DD/MM/AAAA. Revise que no contenga espacios adelante o atrás.',
            'proxima_cita.date_format' => 'La fecha de próxima cita debe tener formato DD/MM/AAAA. Revise que no contenga espacios adelante o atrás.',
            //'ecg.in' => 'La consignación de ECG debe estar entre estos valores :values.',
            //'fecha_cambios_ecg.date_format' => 'La fecha de cambios en ECG debe tener formato DD/MM/AAAA. Revise que no contenga espacios adelante o atrás.',
            'grupo_clinico_ing.between' => 'El campo "Grupo Clínico al ingreso" debe ser un valor entre :min y :max',
            'cambio_grupo_cli.in' => 'El campo "Cambio en Grupo Clinico" debe ser "Si" o "No"',
            'fecha_cambio_gcli.date_format' => 'La fecha de cambio de Grupo Clínico debe tener formato DD/MM/AAAA. Revise que no contenga espacios adelante o atrás.',
            'vivo.in' => 'El campo "Vivo?" debe ser "Si" o "No"',
            'fecha_ini_trat_bnz.date_format' => 'La fecha de inicio del tratamiento con BNZ debe tener formato DD/MM/AAAA. Revise que no contenga espacios adelante o atrás.',
            'efec_otros_bnz.max' => 'Otros efectos adversos del Tratamiento con BNZ debe tener como máximo :max caracteres',
            'fecha_ini_trat_nifur.date_format' => 'La fecha de inicio del tratamiento con Nifurtimox debe tener formato DD/MM/AAAA. Revise que no contenga espacios adelante o atrás.',
            'efec_otros_nifur.max' => 'Otros efectos adversos del Tratamiento con Nifurtimox debe tener como máximo :max caracteres',
            'nuevos_sintomas.in' => 'El campo "¿Hubo nuevos síntomas?" debe ser "Si" o "No"',
            'fecha_rx_torax.date_format' => 'La "Fecha de Radiografía de Tórax" debe tener formato DD/MM/AAAA. Revise que no contenga espacios adelante o atrás.',
            'obs_rxt.max' => 'La observación de la Radiografía debe tener como máximo :max caracteres',
            'fecha_cambios_rxt.date_format' => 'La "Fecha del cambio" de la Radiografía debe tener formato DD/MM/AAAA. Revise que no contenga espacios adelante o atrás.',
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
            //Valida todos los campos editables de la Historia Clinica
            'tipo_doc' => 'alpha|required',
            'numero_doc' => 'numeric|required',
            'fecha_nac' => 'required|date_format:d/m/Y',
            'edad_ing' => 'between:1,130',
            'fecha_alta' => 'required|date_format:d/m/Y',
            'anios_seg' => 'between:1,130',
            'fecha_ult_consulta' => 'date_format:d/m/Y',
            'proxima_cita' => 'date_format:d/m/Y',
            //'ecg' => 'in:E,N,I,?',
            //'tipo_ecg' =>
            //'nuevos_cambios_ecg' =>
            'fecha_cambios_ecg' => 'date_format:d/m/Y',
            //'tipo_cambio_ecg' =>
            //obs_ecg =>
            'grupo_clinico_ing' => 'between:0,3',
            'cambio_grupo_cli' => 'in:N,S',
            'fecha_cambio_gcli' => 'date_format:d/m/Y',
            //'nuevo_grupo_cli' =>
            'vivo' => 'in:N,S',
            //'causa_muerte' =>
            'trat_bnz' => 'in:1,on',
            'fecha_ini_trat_bnz' => 'date_format:d/m/Y',
            'efectos_adv_bnz' => 'in:1,on',
            'efec_rash_bnz' => 'in:1,on',
            'efec_intgas_bnz' => 'in:1,on',
            'efec_afhep_bnz' => 'in:1,on',
            'efec_afneur_bnz' => 'in:1,on',
            'efec_afhem_bnz' => 'in:1,on',
            'susp_bnz' => 'in:1,on',
            'efec_otros_bnz' => 'max:50',
            'trat_nifur' => 'in:1,on',
            'fecha_ini_trat_nifur' => 'date_format:d/m/Y',
            'efectos_adv_nifur' => 'in:1,on',
            'efec_rash_nifur' => 'in:1,on',
            'efec_intgas_nifur' => 'in:1,on',
            'efec_afhep_nifur' => 'in:1,on',
            'efec_afneur_nifur' => 'in:1,on',
            'efec_afhem_nifur' => 'in:1,on',
            'susp_nifur' => 'in:1,on',
            'efec_otros_nifur' => 'max:50',
            //'trat_etio_obs' =>
            'sin_patologia' => 'in:1,on',
            'tuberculosis' => 'in:1,on',
            'epoc' => 'in:1,on',
            'dbt' => 'in:1,on',
            'asintomatico' => 'in:1,on',
            'palpitaciones' => 'in:1,on',
            'angor' => 'in:1,on',
            'colageno' => 'in:1,on',
            'obesidad' => 'in:1,on',
            'alcoholismo' => 'in:1,on',
            'acv' => 'in:1,on',
            'disnea' => 'in:1,on',
            'disnea1' => 'in:1,on',
            'disnea2' => 'in:1,on',
            'disnea3' => 'in:1,on',
            'disnea4' => 'in:1,on',
            'hipotiroidismo' => 'in:1,on',
            'hipertiroidismo' => 'in:1,on',
            'cardio_congenitas' => 'in:1,on',
            'valvulopatias' => 'in:1,on',
            'mareos' => 'in:1,on',
            'cardio_isquemica' => 'in:1,on',
            'ht_arterial_leve' => 'in:1,on',
            'ht_arterial_mode' => 'in:1,on',
            'ht_arterial_severa' => 'in:1,on',
            'perdida_conoc' => 'in:1,on',
            'insuf_cardiaca' => 'in:1,on',
            //'tipo_insuf_card' =>
            //'otras_pat_asoc' =>
            //'otros_sintomas_ing' =>
            "nuevos_sintomas" => 'in:N,S',
            //"obs_sintomas" =>
            'tres_negativas' => 'in:1,on',
            //'serologia_ing' =>
            //'titulos_sero_ing' =>
            //'trat_etio' =>
            'fecha_rx_torax' => 'date_format:d/m/Y',
            //'rx_torax' =>
            //'indice_cardiotorax' =>
            'obs_rxt' => 'max:50',
            //'cambios_rxt' =>
            'fecha_cambios_rxt' =>'date_format:d/m/Y',
            //'nueva_rxt' =>
            //'evolucion' =>
        ];
    }
}
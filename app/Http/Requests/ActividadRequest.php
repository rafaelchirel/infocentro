<?php

namespace Infocentro\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActividadRequest extends FormRequest
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
            'nombre'       => 'required|max:45',
            'descripcion'  => 'required|max:255',
            'fecha'        => 'required',
            'hora_inicio'  => 'required',
            'hora_salida'  => 'required'
        ];
    }
}

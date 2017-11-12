<?php

namespace Infocentro\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipoRequets extends FormRequest
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
            'numero'    => 'required|max:11|unique:equipos,numero,'.$this->get('id'),
            'estatus'   => 'required',
        ];
    }

    public function messages(){
        return [
            'numero.required' => 'Ingrese un numero de Equipo, es obligatorio.',
            'numero.unique' => 'El Numero de Equipo ingresado no esta disponible, asigne otro diferente.'
        ];
    }
}

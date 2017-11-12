<?php

namespace Infocentro\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Usu_PerRequest extends FormRequest
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
            'cedula'         => 'cedula|required|max:12|unique:usu_per,cedula,' . $this->get('id'), 
            'nombre'         => 'required|max:45',
            'apellido'       => 'required|max:45',
            'genero'         => 'required',
            'fecha_nac'      => 'required',
            'email'          => 'max:255|email|unique:usu_per,email,' . $this->get('id'), 
            'telefono'       => 'max:11',
            'direccion'      => 'required|max:255',
            'url_red_social' => 'max:255'
        ];
    }
    public function messages(){
        return [
            'cedula.required'    => 'Es obligatorio que inserte una cedula.',
            'cedula.unique'      => 'Cedula registrada, ingrese una diferente.',
            'fecha_nac.required' => 'Ingrese la Fecha de Nacimiento.',
            'email.unique'       => 'Corre electronico registrado, indique otro distinto.',
            'fecha_nac.required' => 'La fecha de nacimiento es requerida.'
        ];
    }
}

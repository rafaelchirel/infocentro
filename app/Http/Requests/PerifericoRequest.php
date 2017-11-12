<?php

namespace Infocentro\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerifericoRequest extends FormRequest
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
            'nombre' => 'required|max:100|unique:perifericos,nombre,'.$this->get('id'),
        ];
    }

    public function messages(){
        return [
            'nombre.required' => 'Ingrese un Periferico.',
            'nombre.unique'   => 'Este Periferico ya existe, ingrese otro diferente.'
        ];
    }
}

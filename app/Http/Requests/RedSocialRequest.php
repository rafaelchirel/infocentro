<?php

namespace Infocentro\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RedSocialRequest extends FormRequest
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
            'nombre' => 'required|max:25|unique:redes_sociales,nombre,' . $this->get('id'),
        ];
    }
    public function messages(){
        return [
            'nombre.required' => 'El Nombre es requerido, porfavor, ingrese uno',
            'nombre.unique'   => 'Esta Red Social ya existe'
        ];
    }
}

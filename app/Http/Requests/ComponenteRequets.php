<?php

namespace Infocentro\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComponenteRequets extends FormRequest
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
            'marca'       => 'required|max:100',
            'modelo'      => 'required|max:100',
            'serial'      => 'required|max:100|unique:componentes',
            'descripcion' => 'required|max:255',
            'imagen'      => 'required|mimes:jpeg,jpg,png'
        ];
    }

    public function messages(){
        return [
            'serial.unique' => 'Serial en uso, inserte otro distinto.'
        ];
    }
}

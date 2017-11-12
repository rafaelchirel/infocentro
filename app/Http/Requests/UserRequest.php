<?php

namespace Infocentro\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'       => 'required|max:255',
            'email'      => 'required|email|max:255|unique:users,email,' . $this->get('id'),
            'password'   => 'required|min:6|max:255|confirmed',
            'pregunta'   => 'required|max:255',
            'respuesta'  => 'required|max:255',
            'avatar'     => 'mimes:jpeg,bmp,png',
            'avataraux'  => 'required',
            'id'         => 'required'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MesaFormRequest extends FormRequest
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
        return
        [
          'nombre'            => 'required|max:45|min:4',
          'imagen'            => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return
        [
            'required'        => 'Es necesario rellenar el campo :attribute',
            'nombre.max'      => 'El campo :attribute tiene como maximo :max caracteres',
            'nombre.max'      => 'El campo :attribute tiene como minimo :max caracteres',
        ];
    }
}

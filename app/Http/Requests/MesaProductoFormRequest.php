<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MesaProductoFormRequest extends FormRequest
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
           'cantidad'            => 'required|numeric|min:1',
           'producto_id'         => 'required|numeric',
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
             'cantidad.min'    => 'El campo :attribute tiene como minimo :min numero',
             'producto_id.numeric'     => 'Es necesario escoger algun producto',
         ];
     }
}

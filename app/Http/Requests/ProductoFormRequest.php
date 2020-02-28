<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoFormRequest extends FormRequest
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
         'precio'              => 'required|between:0,99.99',
         'nombre'              => 'required|max:45|min:5',
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
           'precio.numeric'  => 'El campo :attribute debe ser un numero',
           'nombre.min'      => 'El campo :attribute tiene como minimo :min',
           'nombre.max'      => 'El campo :attribute tiene como maximo :max',

       ];
   }
}

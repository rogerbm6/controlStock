<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentaFormRequest extends FormRequest
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
         'porcentaje'          => 'required|numeric|max:100|min:0',
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
           'required' => 'Es necesario rellenar el campo :attribute',
           'numeric'  => 'El campo :attribute debe ser un numero',
           'min'      => 'El campo :attribute tiene como minimo :min',
           'max'      => 'El campo :attribute tiene como maximo :max',

       ];
   }
}

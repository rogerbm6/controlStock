<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroFormRequest extends FormRequest
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
         'name'          => 'required|max:45|min:5',
         'email'         => 'email| required',
         'password'      => 'min:8',
         'password_confirmation'=> 'min:8'
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
           'email'    => 'El campo :attribute debe ser un correo valido',
           'min'      => 'El campo :attribute tiene como minimo :min',
           'max'      => 'El campo :attribute tiene como maximo :max',

       ];
   }
}

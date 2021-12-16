<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuario extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'regex:/[A-Z]{1}/', 'regex:/[%_\-&#=\$@]{1,}/','confirmed'],
            'ciudad' => ['required'],
            'num_celular' => ['required', 'string', 'max:10'],
            'dni' => ['required','string', 'max:11'],
            'codigo_ci' => ['required', 'numeric'],
            'fecha_na' =>'required|date|',

        ];

        
    }

    // public function attributes()
    // {
    //     return [ 1234qwe222A_
    //         // 'name' => 'El campo nombre es obligatorio',
    //         // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         // 'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ];
    // }

    public function messages()
    {
        return [
            // 'name.required' => 'este campo es requeridoo',
            // 'password.min' => 'La contraseña debe contener más de 8 caracteres',
            'fecha_na.after' => 'debe ser mayor de edad',
            // 'password.regex' => 'La contraseña debe contener al menos un número,una letra mayúscula, un carácter especial',
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]; 
    }
}

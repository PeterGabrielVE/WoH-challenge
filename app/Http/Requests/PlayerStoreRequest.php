<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PlayerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:players',
            'name' => 'required|string|max:50|unique:players',
            'type' => 'required|integer'
        ];
    }

    public function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(response()->json([

            'success'   => false,

            'message'   => 'Validation errors',

            'data'      => $validator->errors()

        ]));

    }
     

    public function messages()
    {
        return [
            'email.required' => 'Email es obligatorio!',
            'email.email' => 'Tiene que ser un correo valido!',
            'email.unique' => 'Ya existe este  de jugador!',
            'name.required' => 'Nombre es Obligatorio!',
            'name.string' => 'Nombre tiene que ser texto!',
            'name.max' => 'Nombre tiene que tener longitud de 50 caracteres!',
            'name.unique' => 'Ya existe este nombre de jugador!',
            'type.required' => 'Tipo es Requerido!',
            'type.required' => 'Tipo tiene que ser un valor entero'
        ];
    }
}

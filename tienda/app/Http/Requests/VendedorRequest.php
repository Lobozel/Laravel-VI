<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendedorRequest extends FormRequest
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
            'nombre' => ['required'],
            'apellidos' => ['required'],
            'email'=>['required', 'unique:vendedores,email']
        ];
    }

    /**
     * Get messages of validations failure
     *
     * @return array
     */

    public function messages(){

        return [
            'nombre.required'=>'El campo nombre es obligatorio',
            'apellidos.required'=>'El campo apellidos es obligatorio',
            'email.required'=>'Debes introducir un email válido',
            'email.unique'=>'No pueden existir dos vendedores con el mismo email'
        ];
    }

    public function prepareForValidation(){
        if($this->nombre!=null){
            $this->merge([
                'nombre'=>ucwords($this->nombre)
            ]);
        }
        if($this->apellidos!=null){
            $this->merge([
                'apellidos'=>ucwords($this->apellidos)
            ]);
        }
    }
}

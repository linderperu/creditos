<?php

namespace SisCredito\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteFormRequest extends FormRequest
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
            'nombres'=>'required|max:50',
            'apellidos'=>'required|max:50',
            'dniruc'=>'required|max:11',
            'celular'=>'required|max:9',
            'correo'=>'max:50',
            'direccion'=>'required|max:50',
            'distrito'=>'required|max:50',
            'provincia'=>'required|max:50',
            'departamento'=>'required|max:50', 
        ];
    }
}

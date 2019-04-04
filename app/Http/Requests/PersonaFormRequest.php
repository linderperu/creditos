<?php

namespace SisCredito\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonaFormRequest extends FormRequest
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
            'nombres'=>'required|max:120',
            'tipo_documento'=>'required',
            'dniruc'=>'required|max:11',
        
            'direccion'=>'required|max:80',
            'distrito'=>'required|max:50',
            'provincia'=>'required|max:50',
            'departamento'=>'required|max:50', 
        ];
    }
}

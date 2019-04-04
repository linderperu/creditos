<?php

namespace SisCredito\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CajaFormRequest extends FormRequest
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
     *required|max:22|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/
     * 'required|decimal|between:0,99.99',
     * @return array
     */
    public function rules()
    {
        return [
           /* 'iddetallemoneda',
            'idempleado',
            'montoapertura' ,
            'montocierre'=>'decimal',
            'montocorregido'=>'decimal',*/

            'estado'=> 'char',
            'adicionales'=>'max:200',

           
        ];
    }
}

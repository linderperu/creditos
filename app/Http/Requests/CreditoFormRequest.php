<?php

namespace SisCredito\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreditoFormRequest extends FormRequest
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
           
        'idpersona'=>'required',
        'idempleado'=>'required',        
        'idcajero'=>'required',
        'monto'=>'required',
        'tipopago'=>'required',
        'interes'=>'required',        
        'numerocuotas'=>'required',
        'cuotas'=>'required',                    
        'prenda'=>'max:300',            
         ];
    }
}

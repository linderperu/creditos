<?php

namespace SisCredito;

use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    protected $table='credito';
    protected $primaryKey='idcredito';
    public $timestamps=false;

    protected $fillable=[
        'idpersona',
        'idempleado',
        'idempleado',
        'idcajero',
        'monto',
        'tipopago',
        'interes',
        'fechacredito',
        'numerocuotas',
        'cuotas',
        'tipocredito',
        'prenda'

    ];
    protected $GUARDED =[

    ];
}

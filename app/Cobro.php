<?php

namespace SisCredito;

use Illuminate\Database\Eloquent\Model;

class Cobro extends Model
{
    protected $table='cobro';
    protected $primaryKey='idcobro';
    public $timestamps=false;

    protected $fillable=[
        'idcredito',
        'idpersona',
        'idempleado',
        'fechapago',
        'fechdeposito',
        'montoapagar',
        'montocobrado',
        'saldo',
        'cuota',
        'estadocuota',
        'observaciones'

    ];
    protected $GUARDED =[

    ];
}

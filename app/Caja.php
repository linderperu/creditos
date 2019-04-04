<?php

namespace SisCredito;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table='caja';
    protected $primaryKey='idcaja';
    public $timestamps=false;

    protected $fillable=[
        'iddetallemoneda',
        'idempleado',
        'montoapertura',
        'montocierre',
        'montocorregido',
        'fechaapertura',
        'fechacierre',
        'estado',
        'observaciones'

    ];
    protected $GUARDED =[

    ];
}

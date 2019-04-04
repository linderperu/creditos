<?php

namespace SisCredito;

use Illuminate\Database\Eloquent\Model;

class Detallecaja extends Model
{
    protected $table='detallecaja';
     protected $primaryKey='iddetallecaja';
    public $timestamps=false;

    protected $fillable=[
        'idcaja',
        'monto',
        'tipo',
        'descripcion',
        'iduser'
    ];
    protected $GUARDED =[

    ];
}

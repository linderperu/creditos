<?php

namespace SisCredito;

use Illuminate\Database\Eloquent\Model;

class Detallemoneda extends Model
{
    protected $table='detallemoneda';
    protected $primaryKey='iddetallemoneda';
    public $timestamps=false;

    protected $fillable=[
        'idcaja',
        'diezcentimos',
        'veintecentimos',
        'cincuentacentimos',
        'unsol',
        'dossoles',
        'cincosoles',
        'diezsoles',
        'veintesoles',
        'cincuentasoles',
        'ciensoles',
        'doscientos'
    ];
    protected $GUARDED =[

    ];
}

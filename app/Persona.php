<?php

namespace SisCredito;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table='persona';
    protected $primaryKey='idpersona';
    public $timestamps=false;

    protected $fillable=[
'tipo_persona',
'nombres',
'tipo_documento',
'dniruc',
'celular',
'correo',
'direccion',
'distrito',
'provincia',
'departamento',
'condicion'
    ];
    protected $GUARDED =[

    ];
}

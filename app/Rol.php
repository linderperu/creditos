<?php

namespace SisCredito;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table='roles';
    protected $primaryKey='idrol';
    public $timestamps=false;

    protected $fillable=[
        'nombre',
        'descripcion',
        'condicion'       
    ];
        protected $guarded =[

    ];
   
}

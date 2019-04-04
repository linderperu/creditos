<?php

namespace SisCredito;

use Illuminate\Database\Eloquent\Model;

class Interes extends Model
{
    protected $table='interes';
    protected $primaryKey='idinteres';
    public $timestamps=false;

    protected $fillable=[
        'tipopago',
        'interes'              
    ];
        protected $guarded =[

    ];
}

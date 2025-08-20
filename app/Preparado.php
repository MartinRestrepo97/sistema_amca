<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preparado extends Model
{
    protected $table = 'preparados';

    protected $fillable = [
        'nombre',
        'preparacion',
        'observaciones',
        'imagen'
        
    ];
}

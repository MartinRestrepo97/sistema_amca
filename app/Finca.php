<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finca extends Model
{
    protected $table = 'finca';

    protected $fillable = [
        'nombre',
        'ubicacion',
        'propietario',
        'imagen',
    ];
}

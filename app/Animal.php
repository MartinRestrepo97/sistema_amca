<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $table = 'animales';

    protected $fillable = [
        'especie',
        'raza',
        'alimentacion',
        'cuidados',
        'reproduccion',
        'observaciones',
        'imagen',
    ];
}

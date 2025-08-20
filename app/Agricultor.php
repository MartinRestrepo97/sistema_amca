<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agricultor extends Model
{
    protected $table = 'agricultores';

    protected $fillable = [
        'nombres',
        'apellidos',
        'telefono',
        'imagen',
        'documento',
    ];
}

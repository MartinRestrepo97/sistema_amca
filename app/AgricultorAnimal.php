<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgricultorAnimal extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $table = 'agricultores_animales';

    protected $fillable = [
        'id_agricultor',
        'id_animal'
    ];
}

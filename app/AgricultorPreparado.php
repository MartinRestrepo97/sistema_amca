<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgricultorPreparado extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $table = 'agricultores_preparados';

    protected $fillable = [
        'id_agricultor',
        'id_preparado'
    ];
}

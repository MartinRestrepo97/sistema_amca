<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgricultorVegetal extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $table = 'agricultores_vegetales';

    protected $fillable = [
        'id_agricultor',
        'id_vegetal'
    ];
}

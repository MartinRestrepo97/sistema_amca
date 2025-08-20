<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgricultorFinca extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $table = 'agricultores_fincas';

    protected $fillable = [
        'id_agricultor',
        'id_finca'
    ];
}

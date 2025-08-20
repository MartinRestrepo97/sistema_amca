<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vegetal extends Model
{
    protected $table = 'vegetales';

    protected $fillable = [
        'especie',
        'cultivo',
        'observaciones',
        'imagen'
        
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finca extends Model
{
    use HasFactory;
    
    protected $table = 'finca';
    protected $fillable = [
        'nombre', 
        'ubicacion',
        'propietario',
        'imagen',
    ];
    public $timestamps = true;

    public function agricultores()
    {
        return $this->belongsToMany(Agricultor::class, 'agricultores_fincas', 'id_finca', 'id_agricultor');
    }
}

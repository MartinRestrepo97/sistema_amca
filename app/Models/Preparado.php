<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preparado extends Model
{
    use HasFactory;
    
    protected $table = 'preparados';
    protected $fillable = [
        'nombre', 
        'descripcion'
    ];
    public $timestamps = true;

    public function agricultores()
    {
        return $this->belongsToMany(Agricultor::class, 'agricultores_preparados', 'id_preparado', 'id_agricultor');
    }
}

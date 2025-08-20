<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agricultor extends Model
{
    use HasFactory;
    
    protected $table = 'agricultores';
    protected $fillable = [
        'nombres', 
        'apellidos', 
        'telefono', 
        'imagen', 
        'documento'
    ];
    public $timestamps = true;

    public function animales()
    {
        return $this->belongsToMany(Animal::class, 'agricultores_animales', 'id_agricultor', 'id_animal');
    }

    public function fincas()
    {
        return $this->belongsToMany(Finca::class, 'agricultores_fincas', 'id_agricultor', 'id_finca');
    }

    public function preparados()
    {
        return $this->belongsToMany(Preparado::class, 'agricultores_preparados', 'id_agricultor', 'id_preparado');
    }

    public function vegetales()
    {
        return $this->belongsToMany(Vegetal::class, 'agricultores_vegetales', 'id_agricultor', 'id_vegetal');
    }
}

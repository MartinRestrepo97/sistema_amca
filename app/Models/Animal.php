<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;
    
    protected $table = 'animales';
    protected $fillable = [
        'especie', 
        'raza', 
        'alimentacion', 
        'cuidados', 
        'reproduccion', 
        'observaciones', 
        'imagen'
    ];
    public $timestamps = true;

    public function agricultores()
    {
        return $this->belongsToMany(Agricultor::class, 'agricultores_animales', 'id_animal', 'id_agricultor');
    }
}

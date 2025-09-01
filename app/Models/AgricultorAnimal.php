<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgricultorAnimal extends Model
{
    use HasFactory;
    protected $table = 'agricultores_animales';
    protected $fillable = [
        'id_agricultor', 
        'id_animal'
    ];
    public function agricultor()
    {
        return $this->belongsTo(Agricultor::class);
    }
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}

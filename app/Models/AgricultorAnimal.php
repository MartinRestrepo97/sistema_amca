<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgricultorAnimal extends Model
{
    use HasFactory;
    protected $table = 'agricultor_animales';
    protected $fillable = [
        'agricultor_id', 
        'animal_id'
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

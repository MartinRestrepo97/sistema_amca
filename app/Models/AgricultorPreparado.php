<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgricultorPreparado extends Model
{
    use HasFactory;
    protected $table = 'agricultores_preparados';
    protected $fillable = [
        'id_agricultor', 
        'id_preparado'
    ];
    public function agricultor()
    {
        return $this->belongsTo(Agricultor::class, 'id_agricultor');
    }
    public function preparado()
    {
        return $this->belongsTo(Preparado::class, 'id_preparado');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgricultorPreparado extends Model
{
    use HasFactory;
    protected $table = 'agricultor_preparados';
    protected $fillable = [
        'agricultor_id', 
        'preparado_id'
    ];
    public function agricultor()
    {
        return $this->belongsTo(Agricultor::class);
    }
    public function preparado()
    {
        return $this->belongsTo(Preparado::class);
    }
}

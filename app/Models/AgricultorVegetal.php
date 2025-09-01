<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgricultorVegetal extends Model
{
    use HasFactory;
    protected $table = 'agricultores_vegetales';
    protected $fillable = [
        'id_agricultor', 
        'id_vegetal'
    ];
    public function agricultor()
    {
        return $this->belongsTo(Agricultor::class, 'id_agricultor');
    }
    public function vegetal()
    {
        return $this->belongsTo(Vegetal::class, 'id_vegetal');
    }
}

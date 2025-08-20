<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgricultorVegetal extends Model
{
    use HasFactory;
    protected $table = 'agricultor_vegetales';
    protected $fillable = [
        'agricultor_id', 
        'vegetal_id'
    ];
    public function agricultor()
    {
        return $this->belongsTo(Agricultor::class);
    }
    public function vegetal()
    {
        return $this->belongsTo(Vegetal::class);
    }
}

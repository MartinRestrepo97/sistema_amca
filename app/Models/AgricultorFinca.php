<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgricultorFinca extends Model
{
    use HasFactory;
    protected $table = 'agricultor_fincas';
    protected $fillable = [
        'agricultor_id', 
        'finca_id'
    ];
    public function agricultor()
    {
        return $this->belongsTo(Agricultor::class);
    }
    public function finca()
    {
        return $this->belongsTo(Finca::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;
    protected $table = 'historial';
    protected $fillable = [
        'usuarioId',
        'descripcion'
    ];

    public function alumno()
    {
        return $this->belongsTo(User::class,'usuarioId','id');
    }
}

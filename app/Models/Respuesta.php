<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;

    protected $table = 'respuestas';
    protected $fillable = [
        'pregunta_id',
        'respuesta',
        'correcta',
        'fundamento'
    ];

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class,'pregunta_id','id');
    }

    public function respuestaAlumnos()
    {
        return $this->hasMany(RespuestaAlumno::class);
    }
}

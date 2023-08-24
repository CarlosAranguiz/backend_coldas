<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaAlumno extends Model
{
    use HasFactory;
    protected $table = 'respuesta_alumnos';

    protected $fillable = [
        'alumno_id',
        'respuesta_id',
        'fundamento'
    ];

    public function respuesta()
    {
        return $this->belongsTo(Respuesta::class,'respuesta_id','id');
    }

    public function pregunta(){
        return $this->belongsTo(Pregunta::class,'pregunta_id','id');
    }



    public function user()
    {
        return $this->belongsTo(User::class,'alumno_id','id');
    }

}

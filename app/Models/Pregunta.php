<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $table = 'preguntas';

    protected $fillable = [
        'pregunta',
        'examen_id'
    ];


    public function respuestas()
    {
        return $this->hasMany(Respuesta::class, 'pregunta_id', 'id');
    }

    public function opciones()
    {
        return $this->hasMany(QuestionOption::class, 'pregunta_id', 'id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostEventQuestion extends Model
{
    use HasFactory;
    protected $fillable = ['event_id', 'question_text'];

    // Una pregunta pertenece a un evento
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'event_id', 'id');
    }

    // Una pregunta tiene muchas opciones
    public function options()
    {
        return $this->hasMany(PostEventQuestionOption::class, 'post_event_question_id', 'id');
    }

    // Una pregunta tiene muchas respuestas
    public function answers()
    {
        return $this->hasMany(PostEventAnswer::class);
    }
}

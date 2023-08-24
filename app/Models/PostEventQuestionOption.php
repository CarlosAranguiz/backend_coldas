<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostEventQuestionOption extends Model
{
    use HasFactory;
    protected $fillable = ['post_event_question_id', 'option_text'];

    // Una opción pertenece a una pregunta
    public function question()
    {
        return $this->belongsTo(PostEventQuestion::class);
    }

    // Una opción puede tener muchas respuestas (si es una opción múltiple)
    public function answers()
    {
        return $this->hasMany(PostEventAnswer::class);
    }
}

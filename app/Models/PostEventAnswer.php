<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostEventAnswer extends Model
{
    use HasFactory;
    protected $fillable = ['question_id', 'option_id', 'answer_text','user_id'];

    // Una respuesta pertenece a una pregunta
    public function question()
    {
        return $this->belongsTo(PostEventQuestion::class,'question_id','id');
    }

    // Una respuesta puede pertenecer a una opción (si es una respuesta de opción múltiple)
    public function option()
    {
        return $this->belongsTo(PostEventQuestionOption::class,'option_id','id');
    }
}

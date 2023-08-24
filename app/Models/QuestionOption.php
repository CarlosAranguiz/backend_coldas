<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    use HasFactory;
    protected $table = 'question_opt';
    protected $fillable = [
        'pregunta_id',
        'question_opt',
    ];
}

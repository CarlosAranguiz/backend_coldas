<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;
    protected $table = 'eventos';
    protected $fillable = [
        'titulo',
        'descripcion',
        'hora_desde',
        'hora_fin',
        'fecha',
    ];

    public function inscritos()
    {
        return $this->hasMany(InscritoEvento::class, 'id_evento','id');
    }

    // Un evento tiene muchas preguntas
    public function questions()
    {
        return $this->hasMany(PostEventQuestion::class,'event_id','id');
    }
}

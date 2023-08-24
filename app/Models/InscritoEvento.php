<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscritoEvento extends Model
{
    use HasFactory;
    protected $table = 'inscrito_eventos';
    protected $fillable = [
        'id_evento',
        'id_usuario',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}

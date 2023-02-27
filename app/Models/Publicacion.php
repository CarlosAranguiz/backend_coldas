<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $table = 'publicaciones';
    protected $fillable = [
        'titulo',
        'descripcion',
        'ruta_documento',
        'subcategoria'
    ];

    public function subCategoria()
    {
        return $this->belongsTo(Subcategoria::class,'subcategoria','id');
    }
}

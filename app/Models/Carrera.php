<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Universidad;

class Carrera extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_carrera',
        'id_universidad'
    ];

    public function universidad()
    {
        $this->belongsTo(Universidad::class,'id_universidad','id');
    }

    public function getUniversidadAttribute()
    {
        
        $universidad = Universidad::find($this->id_universidad);
        return $universidad->nombre_universidad;
    }
}

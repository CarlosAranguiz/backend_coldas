<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionUtil extends Model
{
    use HasFactory;
    protected $table = 'informacion_util';
    protected $fillable = ['titulo', 'url'];
}
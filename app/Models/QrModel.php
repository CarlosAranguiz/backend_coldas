<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QRModel extends Model
{
    use HasFactory;
    protected $table = 'qrs';

    protected $fillable = [
        'texto_qr',
        'texto_encriptado',
        'url'
    ];
}

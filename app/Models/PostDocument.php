<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostDocument extends Model
{
    use HasFactory;
    protected $table = 'post_documents';
    protected $fillable = [
        'post_id',
        'document_path',
        'document_name',
    ];
}

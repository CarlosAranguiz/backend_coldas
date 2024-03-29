<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'id' ,
        'title' ,
        'description' ,
        'image',
        'date',
        'category',
        'author',
        'content',
        'only_image',
        'created_at',
        'updated_at' ,
        'documents',
    ];

}

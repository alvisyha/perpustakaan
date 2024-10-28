<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'stock',
        'total_pages',
        'cover_image',
        'category',
        'author',
        'publisher',
        'description'
    ];
}

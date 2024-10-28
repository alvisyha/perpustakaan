<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduated extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'nisn',
        'class',
        'graduation',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'book_id',
        'status',
        'note',
        'return_date',
        'returned_date',
        'penalty_price'
    ];

    public function student() {
        return $this->belongsTo('App\Models\Student');
    }

    public function loan_items() {
        return $this->hasMany('App\Models\LoanItem');
    }

    public function book() {
        return $this->belongsTo('App\Models\Book');
    }
}
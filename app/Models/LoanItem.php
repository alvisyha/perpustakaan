<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'book_id',
        'book_title',
        'loan_id',
        'quantity'
    ];
    protected $table = 'loans_items';


    public function student() {
        return $this->belongsTo('App\Models\Student');
    }

    public function book() {
        return $this->belongsTo('App\Models\Book');
    }

    public function loan() {
        return $this->belongsTo('App\Models\Loan');
    }
}

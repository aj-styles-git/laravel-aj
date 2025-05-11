<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //use HasFactory;
    protected $fillable = [
        'student_id',
        'institute_id',
        // add other columns if needed
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id');
    }
}

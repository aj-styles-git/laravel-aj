<?php

namespace App\Models\institutes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\institutes\Institute;
use App\Models\students\Student;
use Carbon\Carbon;

class InstituteRating extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable=[

        "institute_id",
        "student_id",
        "comment",
        "rating",
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function getCreatedAtAttribute($value)
    {
        // Format the 'created_at' attribute using the Carbon instance
        return Carbon::parse($value)->format('d-M-Y');
    }


}

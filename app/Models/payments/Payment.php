<?php

namespace App\Models\payments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\institutes\Institute;
use App\Models\courses\Course;
use App\Models\students\Student;

class Payment extends Model
{
    use HasFactory;

    protected $table="orders";
    // protected $primaryKey="transection_id";
    protected $dates = ['created_at', 'updated_at'];

    public function institute(){
        return $this->hasOne(Institute::class,"id","institute_id");
    }
    public function course(){
        return $this->hasOne(Course::class,"course_id","course_id");
    }
    public function student(){
        return $this->hasOne(Student::class,"id","student_id");
    }
    

    public function getCreatedAtAttribute($value)
    {
        return $this->asDateTime($value)->format('Y-M-d h:i:s');
    }

}

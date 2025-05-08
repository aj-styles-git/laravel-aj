<?php

namespace App\Models\students;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\courses\Course;
use App\Models\app_settings\PushNotification;

class Student extends Authenticatable
{
    use HasApiTokens,HasFactory;
    protected $primaryKey='id';
    // protected $guard='student';
    protected $guarded = [];


    public function courses(){
        return $this->belongsToMany(Course::class,'student_course','student_id','course_id');
    }

    public function push_notificaions()
    {
        return $this->morphMany(PushNotification::class, 'notifiable');
    }

}
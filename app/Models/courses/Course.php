<?php

namespace App\Models\courses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\students\Student;
use App\Models\institutes\Institute;
use App\Models\coupons\Coupon;
use Carbon\Carbon;
use App\Models\app_settings\PushNotification;

class Course extends Model
{
    use HasFactory;
    protected $dates = ['created_at', 'updated_at', 'start_date','end_date'];

    protected $primaryKey = 'course_id';
    public $incrementing = false;

    protected $fillable=[
        'name',
        'topics',
        'title',
        'des',
        'price',
        'course_type',
        'start_date',
        'end_date',
        'seats',
        'seats_male',
         'seats_female',
        'filled_seats',
        'duration',
        'thumbnail',
        'is_featured',
        'software_name',
        'created_by',
        'status',
        'course_link',
        'course_id',
        'category_id',
        'document',
        'specified_for',
        'instructor',
        'reason_id',
        'institute_id',
        'sale_price',
        'language_id'
    
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_course', 'course_id', 'student_id')->withPivot('language_id', 'payment_status','created_at');;

    }

    public function institute()
    {
        return $this->hasOne(Institute::class, 'id', 'institute_id');
    }


    public function hasExpired()
    {
        $now = Carbon::now();
        $endDate = Carbon::parse($this->end_date);

        return $now->greaterThan($endDate);
    }

   
    // public function coupons()
    // {
    //     return $this->hasMany(Coupon::class,'course_id','course_id');
    // }


    public function push_notificaions()
    {
        return $this->morphMany(PushNotification::class, 'notifiable');
    }


    public function getCreatedAtAttribute($value)
    {

        return Carbon::parse($value)->format('d-M-Y H:i:s');
    }
    public function getStartDateAttribute($value)
    {

        return Carbon::parse($value)->format('d-M-Y H:i:s');
    }
    public function getEndDateAttribute($value)
    {

        return Carbon::parse($value)->format('d-M-Y H:i:s');
    }


    public function coupons()
{
    return $this->belongsToMany(Coupon::class, 'course_coupon', 'course_id', 'coupon_id');
}

    

}

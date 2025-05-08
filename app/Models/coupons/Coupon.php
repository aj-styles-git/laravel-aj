<?php

namespace App\Models\coupons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\institutes\Institute;
use App\Models\courses\Course;


class Coupon extends Model
{
    use HasFactory;




    public $fillable = [

        "institute_id",
        "course_id",
        "code",
        "coupon_type",
        'amount'
    ];

    public function hasExpired()
    {
        $now = Carbon::now();
        $endDate = Carbon::parse($this->end_date);

        return $now->greaterThan($endDate);
    }




    public function institute()
    {
        return $this->hasOne(Institute::class, "id", "institute_id");
    }



    public function course()
    {
        return $this->hasOne(Course::class, "course_id", 'course_id');
    }


    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_coupon', 'coupon_id', 'course_id');
    }


    protected static function booted()
    {
        // Detach courses when the coupon is deleted

        try {

            static::deleting(function ($coupon) {
                $coupon->courses()->detach();
            });
        } catch (\Exception $e) {
            $message = "Server Error " . $e->getMessage();
            saveAppLog($message, basename(__FILE__));
            $res['code'] = 403;
            $res['message'] = $message;
            return $res;
        }
    }
}

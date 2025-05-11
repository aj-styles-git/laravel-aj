<?php

namespace App\Models\institutes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Models\courses\Course;
use App\Models\countries\Country;
use App\Models\states\State;
use App\Models\citites\City;
use App\Models\notifications\Notification;
use App\Models\app_settings\PushNotification;
use App\Models\payments\Wallet;
use App\Models\institutes\InstituteRating;
use App\Models\Order;

class Institute extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;
    protected $guard = 'institute';

    protected $fillable = [
        'name',
        'name_en',
        'name_ar',
        'document',
        'approved',
        'contact_person_mobile',
        'mobile',
        'address',
        'email',
        'logo',
        'cover',
        'des',
        'des_en',
        'des_ar',
        'longitude',
        'latitude',
        'city_id',
        'state_id',
        'country_id',
        'country_id',
        'password',
        'updated_at',
        'status',
        'lang',
        'reason',
        'mobileVerified',
        'emailVerified',
        'createdBy',
        'admin_commission',
        'reason_id'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'institute_id', 'id');
    }

    public function ratings()
    {
        return $this->hasMany(InstituteRating::class, 'institute_id', 'id');
    }


    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'institute_id', 'id');
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }


    public function state()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    public function push_notificaions()
    {
        return $this->morphMany(PushNotification::class, 'notifiable');
    }

    public function notifiable()
    {
        return $this->morphTo();
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'institute_id');
    }
}

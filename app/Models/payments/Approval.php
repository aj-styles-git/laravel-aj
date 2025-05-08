<?php

namespace App\Models\payments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\institutes\Institute;
use App\Models\payments\Wallet;

class Approval extends Model
{
    use HasFactory;

    protected $table='withdraw_requests';
    

    public function institute(){
        return $this->hasOne(Institute::class,"id","institute_id");
    }

    public function wallet(){
        return $this->hasOne(Wallet::class,"institute_id");
    }


    public function getCreatedAtAttribute($value)
    {
        return $this->asDateTime($value)->format('d-M-Y H:i:s ');
    }

}

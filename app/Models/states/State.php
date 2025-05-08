<?php

namespace App\Models\states;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\countries\Country ; 

class State extends Model
{
    use HasFactory;


    public function country()
    {
        return $this->hasOne( Country::class,'id','country_id' );
    }

}

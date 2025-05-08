<?php

namespace App\Models\citites;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\states\State ; 
use App\Models\countries\Country ; 

class City extends Model
{
    use HasFactory;
    protected $table="cities";
    
    public function state()
    {
        return $this->hasOne( State::class,'id','state_id' );
    }

    public function country()
    {
        return $this->hasOneThrough( Country::class, State::class,'id','id','id' );
    }

}

<?php

namespace App\Models\countries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\states\State ; 

class Country extends Model
{
    use HasFactory;

    public function state()
    {
        return $this->hasMany( State::class,'country_id','id' );
    }


}

<?php

namespace App\Models\courses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\courses\Course;

class Category extends Model
{
    use HasFactory;

    protected $table="categories";

    protected $fillable=[

        "name",
        "status"
    ];



    public function courses()
    {
        return $this->hasMany(Course::class,'category_id','id');
    }


}

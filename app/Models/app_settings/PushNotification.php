<?php

namespace App\Models\app_settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'title'
      
    ];
    
    public function notifiable()
    {
        return $this->morphTo();
    }


}

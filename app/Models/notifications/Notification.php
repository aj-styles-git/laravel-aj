<?php

namespace App\Models\notifications;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'title',
        'is_read',
        'redirect_url',
        'logo',

    ];

    public function notifiable()
    {
        return $this->morphTo();
    }
}

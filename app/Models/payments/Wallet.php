<?php

namespace App\Models\payments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $table='wallet';
    protected $primaryKey='institute_id';
}

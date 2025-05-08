<?php

namespace App\Models\payments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletMetaData extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $table='wallet_statements';

    protected $fillable=[

        "id",
        "transection_id",
        "withdraw_request_id",
        "transection_type",
        "institute_id",
        "reason",
        "amount",
        "wallet_amount",
        "status",
        "created_at",
        "updated_at",
        "approved_by",
        "message"
    ];

   
    public function getCreatedAtAttribute($value)
    {
        return $this->asDateTime($value)->format('d-M-Y H:i:s ');
    }

}

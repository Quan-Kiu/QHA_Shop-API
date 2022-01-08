<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'fullname',
        'address',
        'phone',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}

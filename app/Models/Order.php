<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'fullname',
        'address',
        'phone',
        'discount_code',
        'unit_price',
        'quantity',
        'delivery_date',
        'order_status_id',
    ];

    public function OrderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function OrderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}

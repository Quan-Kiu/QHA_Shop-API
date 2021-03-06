<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;



    protected $fillable = [
        'name', 'description', 'price', 'stock', 'discount', 'images', 'colors', 'sizes', 'product_type_id', 'thumbnail', 'rating'
    ];

    protected $casts = [
        'images' => 'array',
        'sizes' => 'array',
        'colors' => 'array'
    ];

    public function ProductType()
    {
        return $this->belongsTo(ProductType::class);
    }
    public function Carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function OrderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function Comments()
    {
        return $this->hasMany(Comment::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'images' => 'array',
        'sizes' => 'array',
        'colors' => 'array'
    ];

    public function ProductType()
    {
        return $this->belongsTo(ProductType::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'product_type_id'
    ];

    public function ProductType()
    {
        return $this->belongsTo(ProductType::class);
    }
}

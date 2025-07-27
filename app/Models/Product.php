<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_subcategory_id',
        'name',
        'features',
        'price',
        'status'
    ];

    protected $casts = [
        'features' => 'array',
    ];

    public function subcategory()
    {
        return $this->belongsTo(ProductSubcategory::class, 'product_subcategory_id');
    }
}

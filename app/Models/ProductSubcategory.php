<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSubcategory extends Model
{
    protected $fillable = [
        'product_category_id',
        'name',
        'sub_title',
        'features',
        'description',
        'banner',
        'slug',
        'meta_keywords',
        'status'
    ];

    protected $casts = [
        'features' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'product_subcategory_id');
    }
}

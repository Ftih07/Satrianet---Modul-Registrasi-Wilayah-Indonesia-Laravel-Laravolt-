<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class ProductCategory extends Model
{
    protected $fillable = ['name', 'description', 'status'];

    public function subcategories()
    {
        return $this->hasMany(ProductSubcategory::class);
    }

    public function products(): HasManyThrough
    {
        return $this->hasManyThrough(
            Product::class,
            ProductSubcategory::class,
            'product_category_id',        // Foreign key di subcategory
            'product_subcategory_id',     // Foreign key di product
            'id',                         // Local key di category
            'id'                          // Local key di subcategory
        );
    }
}

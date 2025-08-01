<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = ['name', 'description', 'status'];

    public function subcategories()
    {
        return $this->hasMany(ProductSubcategory::class);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductSubCategory;

class ProductSubCategoryController extends Controller
{
    //

    public function show($slug)
    {
        $subcategory = ProductSubCategory::with(['products', 'category'])
            ->where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return view('subcategories.show', compact('subcategory'));
    }
}

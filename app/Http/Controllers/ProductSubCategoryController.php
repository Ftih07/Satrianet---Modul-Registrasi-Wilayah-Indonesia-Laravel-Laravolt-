<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;
use App\Models\ProductSubCategory;
use Carbon\Carbon;

class ProductSubCategoryController extends Controller
{
    public function show($slug)
    {
        $subcategory = ProductSubCategory::with(['products', 'category'])
            ->where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $otherSubcategories = ProductSubCategory::withCount('products')
            ->where('status', true)
            ->where('id', '!=', $subcategory->id)
            ->latest()
            ->take(10)
            ->get();

        $now = Carbon::now();

        // Ambil semua informasi aktif tanpa filter kategori
        $relatedArticles = Information::with('category')
            ->where('status', true)
            ->where(function ($q) use ($now) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', $now);
            })
            ->where(function ($q) use ($now) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', $now);
            })
            ->latest()
            ->get();

        return view('subcategories.show', compact('subcategory', 'relatedArticles', 'otherSubcategories'));
    }
}

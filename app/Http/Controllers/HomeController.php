<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\CategoryInformation;
use App\Models\ProductCategory;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua banner aktif
        $banners = Banner::where('status', true)->latest()->get();

        // Ambil semua kategori informasi dengan promo aktif
        $categories = CategoryInformation::with(['informations' => function ($query) {
            $query->where('status', true)
                ->where(function ($q) {
                    $q->whereNull('start_date')
                        ->orWhere('start_date', '<=', now());
                })
                ->where(function ($q) {
                    $q->whereNull('end_date')
                        ->orWhere('end_date', '>=', now());
                })
                ->latest();
        }])
            ->whereHas('informations', function ($query) {
                $query->where('status', true)
                    ->where(function ($q) {
                        $q->whereNull('start_date')
                            ->orWhere('start_date', '<=', now());
                    })
                    ->where(function ($q) {
                        $q->whereNull('end_date')
                            ->orWhere('end_date', '>=', now());
                    });
            })
            ->get();

        // Ambil semua kategori produk, dengan subkategori aktif, dan produk di dalam subkategori
        $productCategories = ProductCategory::with(['subCategories' => function ($query) {
            $query->where('status', true)
                ->with(['products' => function ($q) {
                    $q->where('status', true)->latest();
                }]);
        }])
            ->where('status', true)
            ->get();

        return view('home', compact('banners', 'categories', 'productCategories'));
    }
}

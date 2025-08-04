<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;

class InformationsController extends Controller
{
    public function show($slug)
    {
        $information = Information::where('slug', $slug)
            ->where('status', true)
            ->where(function ($q) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', now());
            })
            ->firstOrFail();

        $relatedArticles = Information::where('status', true)
            ->where('id', '!=', $information->id) // selain artikel yang sedang dibuka
            ->where(function ($q) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', now());
            })
            ->with('category') // penting biar kamu bisa akses $article->category->title di view
            ->latest()
            ->limit(3)
            ->get();

        $otherPromos = Information::where('status', true)
            ->where('id', '!=', $information->id) // exclude current
            ->whereHas('category', function ($q) {
                $q->where('title', 'promo'); // hanya kategori dengan name "promo"
            })
            ->latest()
            ->limit(4)
            ->get();

        return view('informations.show', compact('information', 'otherPromos', 'relatedArticles'));
    }
}

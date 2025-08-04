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
                $q->whereNull('start_date')
                    ->orWhere('start_date', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>=', now());
            })
            ->firstOrFail();

        return view('informations.show', compact('information'));
    }
}

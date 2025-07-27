<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PageView;

class LogPageView
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Hanya simpan jika bukan request ke /admin (Filament)
        if (!$request->is('admin/*')) {
            PageView::create([
                'url' => $request->path(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        return $response;
    }
}

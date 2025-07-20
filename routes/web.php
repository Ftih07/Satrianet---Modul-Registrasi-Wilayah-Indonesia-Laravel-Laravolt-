<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\RegistrationController;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

// Group API Indonesia
Route::prefix('api/indonesia')->group(function () {
    Route::get('/cities', function (Request $request) {
        return City::where('province_code', $request->province_id)->get();
    });

    Route::get('/districts', function (Request $request) {
        return District::where('city_code', $request->city_id)->get();
    });

    Route::get('/villages', function (Request $request) {
        return Village::where('district_code', $request->district_id)->get();
    });
});

// Halaman registrasi
Route::get('/registrations/create', [RegistrationController::class, 'create'])->name('registrations.create');
Route::post('/registrations', [RegistrationController::class, 'store'])->name('registrations.store');
Route::get('/registrations/view', [RegistrationController::class, 'index'])->name('registrations.index');

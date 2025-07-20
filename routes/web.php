<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

Route::get('/api/indonesia/cities', function (Request $request) {
    return \Laravolt\Indonesia\Models\City::where('province_code', $request->province_id)->get();
});

Route::get('/api/indonesia/districts', function (Request $request) {
    return \Laravolt\Indonesia\Models\District::where('city_code', $request->city_id)->get();
});

Route::get('/api/indonesia/villages', function (Request $request) {
    return \Laravolt\Indonesia\Models\Village::where('district_code', $request->district_id)->get();
});

use App\Http\Controllers\RegistrationController;

Route::get('/registrations/create', [RegistrationController::class, 'create'])->name('registrations.create');
Route::post('/registrations', [RegistrationController::class, 'store'])->name('registrations.store');


Route::get('/registrations/view', [RegistrationController::class, 'index'])->name('registrations.index');

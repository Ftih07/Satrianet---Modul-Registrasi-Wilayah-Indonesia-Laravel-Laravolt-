<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\RegistrationController;

use Laravolt\Indonesia\Models\{City, District, Village};

Route::prefix('api')->group(function () {
    Route::get('/cities/{province_code}', fn($province_code) =>
        City::where('province_code', $province_code)->get(['code', 'name'])
    );

    Route::get('/districts/{city_code}', fn($city_code) =>
        District::where('city_code', $city_code)->get(['code', 'name'])
    );

    Route::get('/villages/{district_code}', fn($district_code) =>
        Village::where('district_code', $district_code)->get(['code', 'name'])
    );
});

Route::get('/registrations/create', [RegistrationController::class, 'create'])->name('registrations.create');
Route::post('/registrations', [RegistrationController::class, 'store'])->name('registrations.store');
Route::get('/registrations/view', [RegistrationController::class, 'index'])->name('registrations.index');


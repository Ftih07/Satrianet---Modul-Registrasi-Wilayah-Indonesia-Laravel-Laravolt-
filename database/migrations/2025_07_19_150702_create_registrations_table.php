<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('id_product')->unique();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            // Kode wilayah sesuai Laravolt (pakai code, bukan id)
            $table->char('province_code', 2)->nullable();   // contoh: 31
            $table->char('city_code', 4)->nullable();       // contoh: 3171
            $table->char('district_code', 7)->nullable();   // contoh: 3171020
            $table->char('village_code', 10)->nullable();   // contoh: 3171020005

            $table->text('alamat_spesifik')->nullable();
            $table->string('koordinat')->nullable();
            $table->string('referral')->nullable();
            $table->string('status')->nullable()->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};

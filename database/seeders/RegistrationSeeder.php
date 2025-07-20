<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Registration;
use Illuminate\Support\Str;

class RegistrationSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil beberapa data wilayah secara acak dari Laravolt
        $province = \Laravolt\Indonesia\Models\Province::inRandomOrder()->first();
        $city     = $province->cities()->inRandomOrder()->first();
        $district = $city->districts()->inRandomOrder()->first();
        $village  = $district->villages()->inRandomOrder()->first();

        for ($i = 1; $i <= 5; $i++) {
            Registration::create([
                'id_product'      => 'PRD-' . Str::upper(Str::random(6)),
                'name'            => 'User ' . $i,
                'phone'           => '08123' . rand(100000, 999999),
                'email'           => 'user' . $i . '@example.com',
                'province_id'     => $province->id,
                'city_id'         => $city->id,
                'district_id'     => $district->id,
                'village_id'      => $village->id,
                'alamat_spesifik' => 'Jl. Contoh No. ' . $i,
                'koordinat'       => '-6.2' . rand(100, 999) . ',106.8' . rand(100, 999),
                'referral'        => 'REF' . $i,
                'status'          => 'pending',
            ]);
        }
    }
}

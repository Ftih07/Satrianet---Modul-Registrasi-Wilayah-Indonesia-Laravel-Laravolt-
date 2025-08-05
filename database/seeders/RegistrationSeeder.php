<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Registration;
use Illuminate\Support\Facades\File;

class RegistrationSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('data/registrations.json');

        if (!File::exists($path)) {
            $this->command->error("File not found at $path");
            return;
        }

        $json = File::get($path);
        $data = json_decode($json, true);

        if (!is_array($data)) {
            $this->command->error("Invalid JSON structure.");
            return;
        }

        foreach ($data as $item) {
            Registration::create([
                'product_id'       => null,
                'name' => $item['name'] ?? 'Tanpa Nama',
                'phone'            => $item['phone'] ?? null,
                'email'            => $item['email'] ?? null,

                'province_code'    => null,
                'city_code'        => null,
                'district_code'    => null,
                'village_code'     => null,

                'alamat_spesifik'  => $item['address'] ?? null,
                'koordinat'        => $item['koordinat'] ?? null,
                'referral'         => $item['referral'] ?? null,
                'status'           => null,
                'created_at'       => $item['created_at'] ?? now(),
                'updated_at'       => $item['updated_at'] ?? now(),
            ]);
        }

        $this->command->info(count($data) . " registrations imported successfully.");
    }
}

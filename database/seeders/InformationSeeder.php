<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Information;
use Illuminate\Support\Str;

class InformationSeeder extends Seeder
{
    public function run(): void
    {
        $informations = [
            [
                'title' => 'Informasi pembayaran Satrianet',
                'sub_title' => 'Pembayaran mudah dan cepat',
                'slug' => Str::slug('Informasi pembayaran Satrianet') . '-' . uniqid(),
                'category_information_id' => 1,
                'content' => '<p>Bayar Satrianet bisa lewat ATM, mobile banking, atau dompet digital seperti OVO, DANA, LinkAja, dll.</p>',
                'meta_keywords' => 'pembayaran, satrianet, internet',
                'status' => true,
            ],
            [
                'title' => 'Promo spesial pelanggan baru',
                'sub_title' => 'Diskon biaya pemasangan',
                'slug' => Str::slug('Promo spesial pelanggan baru') . '-' . uniqid(),
                'category_information_id' => 1,
                'content' => '<p>Dapatkan potongan biaya pemasangan hingga 50% untuk pelanggan baru Satrianet selama bulan ini.</p>',
                'meta_keywords' => 'promo, diskon, pelanggan baru',
                'status' => true,
            ],
            [
                'title' => 'Gangguan jaringan terjadwal',
                'sub_title' => 'Pemeliharaan sistem',
                'slug' => Str::slug('Gangguan jaringan terjadwal') . '-' . uniqid(),
                'category_information_id' => 1,
                'content' => '<p>Satrianet akan melakukan maintenance jaringan pada tanggal 10 Agustus 2025 pukul 00:00 - 04:00 WIB.</p>',
                'meta_keywords' => 'gangguan, maintenance, jadwal',
                'status' => true,
            ],
            [
                'title' => 'Informasi pembayaran Satrianet',
                'sub_title' => 'Pembayaran mudah dan cepat',
                'slug' => Str::slug('Informasi pembayaran Satrianet') . '-' . uniqid(),
                'category_information_id' => 1,
                'content' => '<p>Bayar Satrianet bisa lewat ATM, mobile banking, atau dompet digital seperti OVO, DANA, LinkAja, dll.</p>',
                'meta_keywords' => 'pembayaran, satrianet, internet',
                'status' => true,
            ],
            [
                'title' => 'Promo spesial pelanggan baru',
                'sub_title' => 'Diskon biaya pemasangan',
                'slug' => Str::slug('Promo spesial pelanggan baru') . '-' . uniqid(),
                'category_information_id' => 1,
                'content' => '<p>Dapatkan potongan biaya pemasangan hingga 50% untuk pelanggan baru Satrianet selama bulan ini.</p>',
                'meta_keywords' => 'promo, diskon, pelanggan baru',
                'status' => true,
            ],
            [
                'title' => 'Gangguan jaringan terjadwal',
                'sub_title' => 'Pemeliharaan sistem',
                'slug' => Str::slug('Gangguan jaringan terjadwal') . '-' . uniqid(),
                'category_information_id' => 1,
                'content' => '<p>Satrianet akan melakukan maintenance jaringan pada tanggal 10 Agustus 2025 pukul 00:00 - 04:00 WIB.</p>',
                'meta_keywords' => 'gangguan, maintenance, jadwal',
                'status' => true,
            ],
        ];

        foreach ($informations as $info) {
            Information::create($info);
        }
    }
}

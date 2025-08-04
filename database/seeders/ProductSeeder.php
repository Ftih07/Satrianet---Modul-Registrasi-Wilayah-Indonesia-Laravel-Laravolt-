<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'product_subcategory_id' => 2,
                'name' => 'Satrianet Fast 200 mbps',
                'features' => [
                    ['feature' => 'Internet dedicated'],
                    ['feature' => 'Metro-E Coverage Jawa, Sumatra, Kalimantan dan Sulawesi'],
                    ['feature' => 'Upload & download 1:1'],
                    ['feature' => 'IP Static'],
                    ['feature' => 'Tanpa batasan quota (Unlimited)'],
                    ['feature' => 'Fiber optic'],
                    ['feature' => 'Helpdesk 24 jam'],
                    ['feature' => 'Diskon 20% biaya pasang'],
                ],
                'price' => 14500000,
                'status' => true,
            ],
            [
                'product_subcategory_id' => 2,
                'name' => 'Satrianet Fast 500 mbps',
                'features' => [
                    ['feature' => 'Internet dedicated'],
                    ['feature' => 'Metro-E Coverage Jawa, Sumatra, Kalimantan dan Sulawesi'],
                    ['feature' => 'Upload & download 1:1'],
                    ['feature' => 'IP Static'],
                    ['feature' => 'Tanpa batasan quota (Unlimited)'],
                    ['feature' => 'Fiber optic'],
                    ['feature' => 'Helpdesk 24 jam'],
                    ['feature' => 'Diskon 20% biaya pasang'],
                ],
                'price' => 24000000,
                'status' => true,
            ],
            [
                'product_subcategory_id' => 2,
                'name' => 'Satrianet Fast 1GB mbps',
                'features' => [
                    ['feature' => 'Internet dedicated'],
                    ['feature' => 'Metro-E Coverage Jawa, Sumatra, Kalimantan dan Sulawesi'],
                    ['feature' => 'Upload & download 1:1'],
                    ['feature' => 'IP Static'],
                    ['feature' => 'Tanpa batasan quota (Unlimited)'],
                    ['feature' => 'Fiber optic'],
                    ['feature' => 'Helpdesk 24 jam'],
                    ['feature' => 'Diskon 20% biaya pasang'],
                ],
                'price' => 24000000,
                'status' => true,
            ],
            [
                'product_subcategory_id' => 2,
                'name' => 'Satrianet Fast 500 mbps',
                'features' => [
                    ['feature' => 'Internet dedicated'],
                    ['feature' => 'Metro-E Coverage Jawa, Sumatra, Kalimantan dan Sulawesi'],
                    ['feature' => 'Upload & download 1:1'],
                    ['feature' => 'IP Static'],
                    ['feature' => 'Tanpa batasan quota (Unlimited)'],
                    ['feature' => 'Fiber optic'],
                    ['feature' => 'Helpdesk 24 jam'],
                    ['feature' => 'Diskon 20% biaya pasang'],
                ],
                'price' => 41000000,
                'status' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

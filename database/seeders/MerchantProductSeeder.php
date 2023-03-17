<?php

namespace Database\Seeders;

use App\Models\MerchantProduct;
use Illuminate\Database\Seeder;

class MerchantProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["product_id" => 1, "price" => 100.00],
            ["product_id" => 2, "price" => 200.00],
            ["product_id" => 3, "price" => 300.00]
        ];

        foreach ($data as $v) {
            MerchantProduct::create([
                "merchant_id" => 1,
                "product_id" => $v["product_id"],
                "status" => MerchantProduct::STATUS_ACTIVE,
                "price" => $v["price"]
            ]);
        }

    }
}

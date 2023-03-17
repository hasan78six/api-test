<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["name" => "Bronze Plan" ,'product_type' => 1, "status" => Product::STATUS_ACTIVE,
                "created_at"=>Carbon::now(), "updated_at"=>Carbon::now()],
            ["name" => "Silver Plan" ,'product_type' => 1, "status" => Product::STATUS_ACTIVE,
                "created_at"=>Carbon::now(), "updated_at"=>Carbon::now()],
            ["name" => "Gold Plan" ,'product_type' => 1, "status" => Product::STATUS_ACTIVE,
                "created_at"=>Carbon::now(), "updated_at"=>Carbon::now()],
        ];

        Product::upsert($data, "name");
    }
}

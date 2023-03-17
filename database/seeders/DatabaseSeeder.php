<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            StatusSeeder::class,
            UserTypeSeeder::class,
            PartnerTypeSeeder::class,
            PartnerSeeder::class,
            ProductTypeSeeder::class,
            ProductSeeder::class,
            MerchantSeeder::class,
            MerchantPartnerSeeder::class,
            MerchantProductSeeder::class
        ]);
    }
}

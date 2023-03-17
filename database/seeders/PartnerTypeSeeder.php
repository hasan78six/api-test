<?php

namespace Database\Seeders;

use App\Models\PartnerType;
use Illuminate\Database\Seeder;

class PartnerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PartnerType::create(["type" => "Payment Gateway", "status" => PartnerType::STATUS_ACTIVE]);
    }
}

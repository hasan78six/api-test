<?php

namespace Database\Seeders;

use App\Models\Partner;
use App\Models\PartnerType;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Partner::create(["name" => "Stripe", "type" => PartnerType::PAYMENT_GATEWAY, "status" => Partner::STATUS_ACTIVE]);
    }
}

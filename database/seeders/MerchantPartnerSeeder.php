<?php

namespace Database\Seeders;

use App\Models\MerchantPartner;
use Illuminate\Database\Seeder;

class MerchantPartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MerchantPartner::create([
            "merchant_id" => 1,
            "partner_id" => 1,
            "status" => MerchantPartner::STATUS_ACTIVE,
            "settings" => ""
        ]);
    }
}

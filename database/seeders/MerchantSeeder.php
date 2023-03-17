<?php

namespace Database\Seeders;

use App\Models\MerchantDetail;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $merchant = User::create([
            "first_name" => "Hasan",
            "last_name" => "Abbas",
            "email" => "hasanabbas78six@gmail.com",
            "password" => Hash::make("hasan@123"),
            "user_type" => UserType::MERCHANT,
            "status" => User::STATUS_ACTIVE
        ]);

        MerchantDetail::create([
            'merchant_id' => $merchant->id,
            'token' => "tk_" . sha1(time()),
            'company_name' => "VAI"
        ]);

    }
}

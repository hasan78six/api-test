<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserType::create(["type" => "Merchant", "status" => UserType::STATUS_ACTIVE]);
        UserType::create(["type" => "User", "status" => UserType::STATUS_ACTIVE]);
    }
}

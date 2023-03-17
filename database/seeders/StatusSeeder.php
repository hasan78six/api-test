<?php

namespace Database\Seeders;

use App\Models\Status;
use App\Models\StatusType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusData = [
            ["type" => "User Type", "status" => ["Active", "In Active"]],
            ["type" => "User", "status" => ["Active", "Blocked"]],
            ["type" => "Partner Type", "status" => ["Active", "In Active"]],
            ["type" => "Partner", "status" => ["Active", "In Active"]],
            ["type" => "Product Type", "status" => ["Active", "In Active"]],
            ["type" => "Product", "status" => ["Active", "In Active"]],
            ["type" => "Merchant Partner", "status" => ["Active", "In Active"]],
            ["type" => "Merchant Product", "status" => ["Active", "In Active"]],
            ["type" => "Subscription", "status" => ["Active", "Pending", "Cancelled"]],
        ];

        foreach ($statusData as $data) {
            $type = StatusType::create(["type" => $data["type"]]);

            foreach ($data["status"] as $status) {
                Status::create(["type_id" => $type->id, "status" => $status]);
            }
        }
    }
}

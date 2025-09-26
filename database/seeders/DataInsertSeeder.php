<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Building;
use App\Models\Flat;
use App\Models\Tenant;
use App\Models\BillCategory;

class DataInsertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $building = Building::create([
            'id' => 1,
            'name' => 'Sample Building',
            'house_owner_id' => 1,
            'address' => '123 Main Street, Dhaka',
        ]);

        $flat = Flat::create([
            'id' => 1,
            'house_owner_id' => 1,
            'building_id' => 1,
            'flat_number' => '101',
            'flat_owner_name' => 'Karim',
            'flat_owner_contact' => 3497290000,
        ]);

        Tenant::create([
            'id' => 1,
            'name' => 'Tenant 1',
            'email' => 'tenant1@example.com',
            'contact' => '01710000001',
            'house_owner_id' => 1,
            'building_id' => 1,
            'flat_id' => 1,
        ]);

        BillCategory::create([
            'id' => 1,
            'house_owner_id' => 1,
            'name' => 'Water Bill',
        ]);
    }
}

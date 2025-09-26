<?php

namespace Database\Seeders;

use App\Models\HouseOwner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $houseOwnerRole = Role::firstOrCreate(['name' => 'house-owner']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Super Admin', 'password' => bcrypt('password')]
        );
        $admin->assignRole($superAdmin);

        $user = User::firstOrCreate(
            ['email' => 'houseowner@example.com'],
            ['name' => 'Sample House Owner', 'password' => bcrypt('password')]
        );
        $user->assignRole($houseOwnerRole);
        HouseOwner::firstOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $user->name,
                'email' => $user->email,
                'contact' => $user->contact
            ]
        );
    }
}

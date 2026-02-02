<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $customerRole = Role::where('name', 'customer')->first();

        User::firstOrCreate(
            ['email' => 'admin@marketing.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('123456789'),
                'role_id' => $adminRole->id
            ]
        );

        User::firstOrCreate(
            ['email' => 'customer@marketing.com'],
            [
                'name' => 'Customer1',
                'password' => Hash::make('123456789'),
                'role_id' => $customerRole->id
            ]
        );
    }
}

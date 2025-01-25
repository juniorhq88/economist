<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);

        User::factory()->create([
            'name' => 'Junior Hernandez',
            'email' => 'superadmin@economista.mx',
            'password' => Hash::make('Qwerty12345#'),
        ])->each(function ($user) {
            $user->assignRole('SuperAdmin');
        });

        User::factory()->create([
            'name' => 'Hanna',
            'email' => 'hanna@economista.mx',
            'password' => Hash::make('1234567890'),
        ])->each(function ($user) {
            $user->assignRole('Customer');
        });
    }
}

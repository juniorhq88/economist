<?php

namespace Database\Seeders;

use App\Enum\UserType;
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

        $user = User::factory()->create([
            'name' => 'Junior Hernandez',
            'email' => 'superadmin@economista.mx',
            'password' => Hash::make('Qwerty12345#'),
        ]);
        $user->assignRole(UserType::SuperAdmin->value);

        $user2 = User::factory()->create([
            'name' => 'Hanna',
            'email' => 'hanna@economista.mx',
            'password' => Hash::make('1234567890'),
        ]);
        $user2->assignRole(UserType::Customer->value);
    }
}

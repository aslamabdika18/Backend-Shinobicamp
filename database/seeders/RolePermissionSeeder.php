<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $coachRole = Role::create(['name' => 'coach']);

        // Buat admin default
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@shinobi.com',
            'password' => Hash::make('password123'),
        ]);

        // Assign role admin
        $admin->assignRole('admin');
    }
}

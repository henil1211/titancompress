<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Roles
        $superAdmin = \Spatie\Permission\Models\Role::create(['name' => 'Super Admin']);
        $salesManager = \Spatie\Permission\Models\Role::create(['name' => 'Sales Manager']);
        
        // Create Permissions
        \Spatie\Permission\Models\Permission::create(['name' => 'manage products']);
        \Spatie\Permission\Models\Permission::create(['name' => 'manage rfqs']);
        \Spatie\Permission\Models\Permission::create(['name' => 'manage cms']);
        
        // Assign Permissions to Roles
        $superAdmin->givePermissionTo(\Spatie\Permission\Models\Permission::all());
        $salesManager->givePermissionTo(['manage products', 'manage rfqs']);

        // Create Super Admin User
        $user = \App\Models\User::create([
            'name' => 'Headquarters Admin',
            'email' => 'admin@titancompress.com',
            'password' => \Illuminate\Support\Facades\Hash::make('TitanPower2026!'),
            'email_verified_at' => now(),
        ]);

        $user->assignRole($superAdmin);
    }
}

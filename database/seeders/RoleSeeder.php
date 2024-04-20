<?php

namespace Database\Seeders;
use App\Models\Role;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define roles
        $roles = [
            ['name' => 'student'],
            ['name' => 'teacher'],
            ['name' => 'supervisor'],
            ['name' => 'guest'],
            ['name' => 'admin']
        ];

        // Insert roles into the database
        Role::insert($roles);
    }
}

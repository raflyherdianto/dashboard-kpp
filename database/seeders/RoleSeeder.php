<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Planner', 'Instruktur', 'Gl Wali', 'Asesor', 'Mekanik'];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}

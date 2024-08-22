<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            SiteSeeder::class,
            DepartmentSeeder::class,
            PositionSeeder::class,
            EgiSeeder::class,
            CompetenceSeeder::class,
            SubCompetenceSeeder::class,
            SubEgiSeeder::class,
        ]);
        User::factory()->create([
            'nrp' => 'ASD',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
        ])->assignRole('Planner');
        $this->call([
            UserSeeder::class
        ]);
    }
}

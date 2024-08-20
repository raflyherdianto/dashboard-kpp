<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            [
                'name' => 'OPSM',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Plant & SM',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Plant Hauling',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Plant Site',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Plant Track',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Plant Wheel',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'BARGE LOADER MECHANIC',
            'CRUSHER MECHANIC',
            'HAULING TYPE MECHANIC',
            'MECHANIC',
            'PLANT HAULING MECHANIC',
            'PLANT MECHANIC',
            'SSE MECHANIC',
            'SSE TYPE MECHANIC',
            'TRACK TYPE MECHANIC',
            'WHEEL TYPE MECHANIC'
        ];
        foreach ($names as $name) {
            DB::table('positions')->insert([
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}

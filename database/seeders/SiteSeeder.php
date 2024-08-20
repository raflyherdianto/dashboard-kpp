<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'AGMR',
            'ASTO',
            'BDMA',
            'IHPK',
            'INDE',
            'MASS',
            'PELH',
            'RANT',
            'SJRP',
            'SPRL',
            'SPUT',
            'TMRB'
        ];

        foreach ($names as $name) {
            DB::table('sites')->insert([
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}

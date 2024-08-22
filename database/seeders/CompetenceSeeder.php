<?php

namespace Database\Seeders;

use App\Models\Competence;
use App\Models\Egi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maintenanceTasks = [
            "I" => "PREVENTIVE MAINTENANCE",
            "II" => "REMOVE & INSTALL",
            "III" => "OVERHAULING",
            "IV" => "MACHINE TROUBLESHOOTING",
            "V" => "TECHNICAL INSTRUCTION",
            "VI" => "REPAIR"
        ];

        $egis = Egi::all();

        foreach ($egis as $egi) {
            foreach ($maintenanceTasks as $code => $name) {
                Competence::create([
                    'egi_id' => $egi->id,
                    'code' => $code,
                    'name' => $name,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}

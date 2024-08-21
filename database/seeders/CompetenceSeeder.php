<?php

namespace Database\Seeders;

use App\Models\Competence;
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

        foreach ($maintenanceTasks as $code => $name) {
            Competence::create([
                'code' => $code,
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

    }
}

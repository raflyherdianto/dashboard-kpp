<?php

namespace Database\Seeders;

use App\Models\Egi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EgiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $egi = [
            "DUMP TRUCK",
            "WHEEL LOADER",
            "MOTOR GRADER",
            "ARTICULATED",
            "BULLDOZER",
            "EXCAVATOR",
            "VOLVO HAULING",
            "SCANIA HAULING",
            "DRILLING",
            "PUMPING",
            "LIGHTING",
            "LIFTING",
            "LIGHT TRUCK",
            "BARGE LOADER & CRUSHER",
            "TRAILER",
            "BOMAG",
            "NISSAN QUESTER"
        ];

        foreach ($egi as $eq) {
            Egi::create([
                'name' => $eq,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}

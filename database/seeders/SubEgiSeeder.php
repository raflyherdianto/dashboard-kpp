<?php

namespace Database\Seeders;

use App\Models\SubEgi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubEgiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'HD465-5',
            'HD785-3',
            'HD785-5',
            'HD465-7',
            'HD785-7',
            'HD1500',
            'EH1700',
            'WA180',
            'WA470',
            'WA500',
            'WA600',
            'WA800',
            'GD705',
            'GD825',
            '24H',
            'HM 400',
            'A35C',
            'A40D',
            'D85SS',
            'D155',
            'D375',
            'D475',
            'PC200',
            'PC400',
            'PC750-6',
            'PC750-7',
            'PC1100',
            'PC1250-7',
            'PC1800',
            'PC2000',
            'ZX870',
            'ZX1200',
            'VOLVO PM',
            'VOLVO LD',
            'SCANIA PM',
            'SCANIA LD',
            'TAMROCK',
            'TITON',
            'REEDRIL',
            'DRILLTECH',
            'IR',
            'LEGRA',
            'G12',
            'KSB',
            'MULTIFLO',
            '<150 KVA',
            '>150 KVA',
            'TADANO',
            'MANITOU',
            'FORKLIFT',
            'CRANE TRUCK',
            'NISSAN',
            'VOLVO',
            'SCANIA',
            'ISUZU',
            'IVECO',
            'CRUSHER',
            'SDT60',
            'SST74',
            'BW211',
            'BW216',
            'NISSAN PM',
            'NISSAN LD'
        ];

        foreach ($data as $value) {
            SubEgi::create([
                'name' => $value,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

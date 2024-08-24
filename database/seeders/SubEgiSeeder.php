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
            ['egi_id' => 1, 'name' => 'HD465-5'],
            ['egi_id' => 1, 'name' => 'HD785-3'],
            ['egi_id' => 1, 'name' => 'HD785-5'],
            ['egi_id' => 1, 'name' => 'HD465-7'],
            ['egi_id' => 1, 'name' => 'HD785-7'],
            ['egi_id' => 1, 'name' => 'HD1500'],
            ['egi_id' => 1, 'name' => 'EH1700'],
            ['egi_id' => 2, 'name' => 'WA180'],
            ['egi_id' => 2, 'name' => 'WA470'],
            ['egi_id' => 2, 'name' => 'WA500'],
            ['egi_id' => 2, 'name' => 'WA600'],
            ['egi_id' => 2, 'name' => 'WA800'],
            ['egi_id' => 3, 'name' => 'GD705'],
            ['egi_id' => 3, 'name' => 'GD825'],
            ['egi_id' => 3, 'name' => '24H'],
            ['egi_id' => 4, 'name' => 'HM 400'],
            ['egi_id' => 4, 'name' => 'A35C'],
            ['egi_id' => 4, 'name' => 'A40D'],
            ['egi_id' => 5, 'name' => 'D85SS'],
            ['egi_id' => 5, 'name' => 'D155'],
            ['egi_id' => 5, 'name' => 'D375'],
            ['egi_id' => 5, 'name' => 'D475'],
            ['egi_id' => 6, 'name' => 'PC200'],
            ['egi_id' => 6, 'name' => 'PC400'],
            ['egi_id' => 6, 'name' => 'PC750-6'],
            ['egi_id' => 6, 'name' => 'PC750-7'],
            ['egi_id' => 6, 'name' => 'PC1100'],
            ['egi_id' => 6, 'name' => 'PC1250-7'],
            ['egi_id' => 6, 'name' => 'PC1800'],
            ['egi_id' => 6, 'name' => 'PC2000'],
            ['egi_id' => 6, 'name' => 'ZX870'],
            ['egi_id' => 6, 'name' => 'ZX1200'],
            ['egi_id' => 7, 'name' => 'VOLVO PM'],
            ['egi_id' => 7, 'name' => 'VOLVO LD'],
            ['egi_id' => 8, 'name' => 'SCANIA PM'],
            ['egi_id' => 8, 'name' => 'SCANIA LD'],
            ['egi_id' => 9, 'name' => 'TAMROCK'],
            ['egi_id' => 9, 'name' => 'TITON'],
            ['egi_id' => 9, 'name' => 'REEDRIL'],
            ['egi_id' => 9, 'name' => 'DRILLTECH'],
            ['egi_id' => 9, 'name' => 'IR'],
            ['egi_id' => 10, 'name' => 'LEGRA'],
            ['egi_id' => 10, 'name' => 'G12'],
            ['egi_id' => 10, 'name' => 'KSB'],
            ['egi_id' => 10, 'name' => 'MULTIFLO'],
            ['egi_id' => 11, 'name' => '<150 KVA'],
            ['egi_id' => 11, 'name' => '>150 KVA'],
            ['egi_id' => 12, 'name' => 'TADANO'],
            ['egi_id' => 12, 'name' => 'MANITOU'],
            ['egi_id' => 12, 'name' => 'FORKLIFT'],
            ['egi_id' => 12, 'name' => 'CRANE TRUCK'],
            ['egi_id' => 13, 'name' => 'NISSAN'],
            ['egi_id' => 13, 'name' => 'VOLVO'],
            ['egi_id' => 13, 'name' => 'SCANIA'],
            ['egi_id' => 13, 'name' => 'ISUZU'],
            ['egi_id' => 13, 'name' => 'IVECO'],
            ['egi_id' => 14, 'name' => 'CRUSHER'],
            ['egi_id' => 15, 'name' => 'SDT60'],
            ['egi_id' => 15, 'name' => 'SST74'],
            ['egi_id' => 16, 'name' => 'BW211'],
            ['egi_id' => 16, 'name' => 'BW216'],
            ['egi_id' => 17, 'name' => 'NISSAN PM'],
            ['egi_id' => 17, 'name' => 'NISSAN LD'],
        ];



        foreach ($data as $value) {
            SubEgi::create([
                'egi_id' => $value['egi_id'],
                'name' => $value['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

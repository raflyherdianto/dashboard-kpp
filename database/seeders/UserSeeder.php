<?php

namespace Database\Seeders;

use App\Models\GlWali;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'nrp' => Str::upper(Str::random(3)) . rand(100, 999),
                'name' => 'BAMBANG SUPRIADI',
                'email' => 'bambangsupriadi@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'nrp' => Str::upper(Str::random(3)) . rand(100, 999),
                'name' => 'ERWIN IRAWAN',
                'email' => 'erwinirawan@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'nrp' => Str::upper(Str::random(3)) . rand(100, 999),
                'name' => 'GAJALI FERDINAND',
                'email' => 'gajaliferdinand@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'nrp' => Str::upper(Str::random(3)) . rand(100, 999),
                'name' => 'HADI ASMUNGI',
                'email' => 'hadiasmungi@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'nrp' => Str::upper(Str::random(3)) . rand(100, 999),
                'name' => 'IRFAN ROMANSAH',
                'email' => 'irfanromansah@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'nrp' => Str::upper(Str::random(3)) . rand(100, 999),
                'name' => 'PALENTINUS PANJAITAN',
                'email' => 'palentinuspanjaitan@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'nrp' => Str::upper(Str::random(3)) . rand(100, 999),
                'name' => 'PURNA IRAWAN',
                'email' => 'purnairawan@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'nrp' => Str::upper(Str::random(3)) . rand(100, 999),
                'name' => 'SOFYAN HADI',
                'email' => 'sofyanhadi@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'nrp' => Str::upper(Str::random(3)) . rand(100, 999),
                'name' => 'ZAINUDIN',
                'email' => 'zainudin@gmail.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $userData) {
            // Insert user data and retrieve the instance
            $user = User::create($userData);

            GlWali::create([
                'wali_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            // Assign role to the user
            $user->assignRole('Gl Wali');
        }
    }
}

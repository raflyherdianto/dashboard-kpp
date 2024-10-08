<?php

namespace Database\Seeders;

use App\Models\SubCompetence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            'Daily Check',
            'Periodical Service',
            'Inspection / Quick PM',
            'Engine',
            'Alternator',
            'Starting Motor',
            'Turbocharger',
            'Fuel Pump',
            'Injector/Nozzle',
            'Water Pump',
            'Air Compressor',
            'Engine Oil Pump',
            'Radiator & cooling system',
            'Torqflow transmission',
            'Front axle & wheel',
            'Rear axle & wheel',
            'Differential',
            'Front Suspension',
            'Rear Suspension',
            'Hydraulic Pump',
            'Hydraulic Control Valve',
            'Hydraulic Cylinder',
            'Steering Pump and Valve',
            'Steering Demand Valve',
            'Steering Valve and Accumulator',
            'Steering Cylinder',
            'Brake Valves and Accumulator',
            'Brake Chamber',
            'Front Brake',
            'Rear Brake',
            'Parking Brake',
            'Electric Harness',
            'Electric Component',
            'Vessel',
            'Cabin',
            'Fire Supression',
            'Air Conditioner',
            'Auto lubrication Lincoln',
            'Auto lubrication Vogel',
            'Propeller shaft & U-Joint',
            'Damper',
            'Front axle',
            'Final Drive',
            'Suspension',
            'Power Train',
            'Hydraulic',
            'Steering',
            'Air System',
            'Brake System',
            'Electrical System',
            'PPM',
            'PAP',
            'Technical instruction',
            'Adjust Valve',
            'Steering Pump',
            'Steering Valve',
            'Brake Valve and Relay Valve',
            'Auto lubrication',
            'Frame & Chassis',
            'Steering Control Valve',
            'Brake Pump',
            'Attachment',
            'Brake',
            'Fuel Pump/HEUI Pump',
            'Air Compressor & Air Tank',
            'Torque Converter',
            'Transmission Pump',
            'Hydroshift transmission',
            'Tandem & Wheel',
            'Hydraulic & Steering Pump',
            'Accumulator',
            'Hydraulic & Steering Cylinder',
            'Air control valve',
            'Paking Brake',
            'Electrical harness',
            'Electrical components',
            'Circle & Drawbar',
            'Tandem',
            'Intercooler',
            'Power Train Module',
            'Front Suspension/Rubber',
            'Rear Suspension & Bogie',
            'Drop box',
            'Suspension/Boggie',
            'Power Train Pump',
            'Steering and Brake Valve',
            'Transmission and TC Control Valve',
            'Transmission module',
            'Transmission',
            'Bevel Gear',
            'Steering Clutch and Brake',
            'Undercarriage Assy',
            'Steering and Brake',
            'Hydraulic System',
            'Steering & Brake System',
            'Electric System',
            'PPU',
            'Re-Seal Track Adjuster',
            'Radiator and Cooling System',
            'Oil Cooler',
            'Fan Motor',
            'Swing Machinarry',
            'Swing Circle (Swing Ring)',
            'Swing Motor',
            'Rotary Valve',
            'Travel Motor',
            'Final Drive and Travel Brake',
            'PTO',
            'Track Adjuster & Accumulator',
            'Swing Circle',
            'Travel Brake',
            'Travel System',
            'Swing System',
            'Swing Circle ( Swing Ring )',
            'Fuel Pump/FIP',
            'Nozzle/Injector',
            'Clutch',
            'Front Axle and Wheel',
            'Rear Axle and Wheel',
            'Steering Gearbox',
            'Steering Lingkage',
            'Brake Valves',
            'Boggie and Suspension',
            'Hydraulic Pump / PTO',
            'Fith Wheel',
            'Rear Axle',
            'Steering System',
            'HEUI Pump',
            'Injector',
            'Gear Box / PTO',
            'Air End Compressor',
            'Buterfly Valve',
            'Poppet Valve',
            'Hydraulic Control Valves',
            'Hydraulic Motor Rotary Head',
            'Rock Drill',
            'Rotary Head',
            'Down Hole Drill',
            'Travel Motor and Travel Brake',
            'Pull Down Gear Box',
            'Chain and Wire Rop',
            'GET',
            'Under Carriage Assy',
            'Track Adjuster',
            'Gear Box & PTO',
            'Pull Down Gear Box / Rotary Head',
            'Air End Compressor',
            'Hydraulic Motor',
            'Radiator & Cooling',
            'Engine / Motor',
            'Clutch / Damper',
            'Transmission & Clutch',
            'Canopy & Ponton',
            'VAccuum pump',
            'Bare shaft',
            'Motor',
            'Pump',
            'Clucth',
            'Transmission',
            'Canopy',
            'Electrical',
            'Canopy & Skidding',
            'Generator',
            'Coupling / Damper',
            'Electric Control Panel Box',
            'Generator System',
            'Electric System',
            'Attachment / Tower',
            'Transmission & transfer',
            'Front & rear axle',
            'Air Conditioner',
            'Cabin / Canopy',
            'Hydraulic Component',
            'Swing machinery',
            'Rotary Joint',
            'Chain , Wire Rope & Hook',
            'Hydraulic Motor & Winch',
            'Hydraulic motor',
            'Front & rear axle',
            'Steering Component',
            'Air & brake Component',
            'Air',
            'Electric',
            'Boggie and Suspension',
            'Jaw Crusher',
            'Gyratory Crusher',
            'Cone Crusher',
            'Single Roll',
            'VSI',
            'Double Roll',
            'Frame Conveyor',
            'Turntable Device',
            'Frame Roller',
            'Roller',
            'Gallery',
            'Swing Device (Radial Stacker)',
            'Belt Conveyor',
            'Belt Cleaner',
            'Drum Pulley',
            'Skirtboard/Plate',
            'Transfer Chute',
            'Hopper',
            'Grizzly/Screen',
            'Chain Feeder',
            'Electic Motor',
            'Gearbox',
            'Coupling',
            'Dropbox',
            'Vibration Screen',
            'Roller screen',
            'Magnetic Separator',
            'Water Service Installation',
            'Auto Lubrication Graco',
            'Automatic Sampler',
            'Safety & Hazard',
            'Starter Motor AC',
            'Panel AC',
            'Lighting',
            'Trafo',
            'Cubicle',
            'Tower Station',
            'HSI',
            'Electric Harness & Component',
            'Vessel Attachment',
            'Alllighment Axle',
            'Travel Pump',
            'Vibration Pump',
            'Axle Drive Motor',
            'Drum Drive Motor',
            'Vibration Motor',
            'Axle',
            'Front Drum',
            'Articulated Joint',
            'Vibration System'
        ];



        foreach ($items as $eq) {
            SubCompetence::create([
                'name' => $eq,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}

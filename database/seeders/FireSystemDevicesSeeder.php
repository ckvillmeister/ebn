<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FireSystemDevices;

class FireSystemDevicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $devices = [
            [1, 'Fire Alarm Panel'], 
            [1, 'Smoke Detectors'], 
            [1, 'Heat Detectors'], 
            [1, 'Waterflow Switches'], 
            [1, 'Supervisory Switches'],
            [1, 'Others'],
            [2, 'Fire Alarm Bell'],
            [2, 'Manual Pull Station'],
            [2, 'Horns'],
            [2, 'Chimes'],
            [2, 'Strobes'],
            [2, 'Speakers'],
            [2, 'Others']
        ];

        foreach ($devices as $key => $device) {
            FireSystemDevices::create([
                'category_id' => $device[0],
                'name' => $device[1]
                ]);
        }
    }
}

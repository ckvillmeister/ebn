<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FireSystemDeviceCategories;

class FireSystemDeviceCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
                        'Alarm Initiating Devices and Circuit Information', 
    					'Alarm Notifications Appliances and Circuit Information'
                    ];

    	foreach ($categories as $key => $category) {
    		FireSystemDeviceCategories::create([
					'category' => $category
					]);
    	}
    }
}

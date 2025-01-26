<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AttachmentTypes;

class AttachmentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
			'Control Panel',
			'Conventional Fire Alarm System',
			'Emergency Light',
			'Exterior Details',
			'Fire Drill Certificate',
			'Fire Evacuation Plan',
			'Fire Exit with Panic Device & Alarm System',
			'Fire Extinguishers',
			'Fire Safety Inspection Certificate',
			'Interior Details',
			'Manual Pull & Strobe Light',
			'Smoke Detector',
			
		];

    	foreach ($types as $key => $type) {
    		AttachmentTypes::create([
					'description' => $type
					]);
    	}
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FSMRContent;

class FSMRContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contents = ['Facility Description', 
    					'Fire Safety Plan', 
    					'Fire Detection System', 
    					'Fire Suppression System', 
    					'Statement of Testing & Commmissioning', 
    					'Certification',
						'Conclusion & Recommendations'
					];

    	foreach ($contents as $key => $content) {
    		FSMRContent::create([
					'description' => $content
					]);
    	}
    }
}

<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidTblDefaultUploadTypesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'DTI Permit'],
            ['name' => 'PhilGEPS Certificate'],
            ['name' => "Mayor's Permit"],
            ['name' => 'BIR Certificate of Registration'],
            ['name' => 'Audited Financial Statement'],
            ['name' => 'Tax Clearance Certificate'],
            ['name' => 'Organizational Chart'],
            ['name' => 'Tools and Equipments Requirement'],
            ['name' => 'Brochure']
        ];

        foreach ($data as &$item) {
            $item['status'] = 1;
            $item['created_at'] = now();
            $item['updated_at'] = now();
        }

        DB::table('bid_tbl_default_upload_types')->insert($data);
    }
}

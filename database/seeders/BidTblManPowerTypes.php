<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidTblManPowerTypes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Project Manager'],
            ['name' => 'Engineer'],
            ['name' => 'Technicians'],
            ['name' => 'Laborers'],
            ['name' => 'QA Team'],
            ['name' => 'Procurement Officer'],
            ['name' => 'Warehouse Personnel'],
            ['name' => 'Quality Control Inspector'],
            ['name' => 'Delivery Driver'],
            ['name' => 'Delivery Helpers'],
            ['name' => 'Administrative Staff']
        ];

        foreach ($data as &$item) {
            $item['status'] = 1;
            $item['created_at'] = now();
            $item['updated_at'] = null;
        }

        DB::table('bid_tbl_man_power_types')->insert($data);
    }
}

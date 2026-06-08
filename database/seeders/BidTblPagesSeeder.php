<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidTblPagesSeeder extends Seeder
{
    public function run()
    {
        $data = [

            // TECHNICAL COMPONENTS
            ['page_name' => 'Front Page', 'component_type' => 'Technical Components', 'order' => 1],
            ['page_name' => 'Cover Page', 'component_type' => 'Technical Components', 'order' => 1],
            ['page_name' => 'DTI', 'component_type' => 'Technical Components', 'order' => 2],
            ['page_name' => 'PhilGEPS', 'component_type' => 'Technical Components', 'order' => 3],
            ['page_name' => "Mayor's Permit", 'component_type' => 'Technical Components', 'order' => 4],
            ['page_name' => 'BIR Certificate of Registration', 'component_type' => 'Technical Components', 'order' => 5],
            ['page_name' => 'Statement of All Ongoing Government and Private Contracts', 'component_type' => 'Technical Components', 'order' => 6],
            ['page_name' => 'Statement of Single Largest Completed Contract', 'component_type' => 'Technical Components', 'order' => 7],
            ['page_name' => 'Notice to Proceed', 'component_type' => 'Technical Components', 'order' => 8],
            ['page_name' => 'Notice of Awards', 'component_type' => 'Technical Components', 'order' => 9],
            ['page_name' => 'Certificate from Project Proponent', 'component_type' => 'Technical Components', 'order' => 10],
            ['page_name' => 'Audited Financial Statement', 'component_type' => 'Technical Components', 'order' => 11],
            ['page_name' => 'Net Financial Contracting Capacity', 'component_type' => 'Technical Components', 'order' => 12],
            ['page_name' => 'Tax Clearance Certificate', 'component_type' => 'Technical Components', 'order' => 13],
            ['page_name' => 'Bid Securing Declaration', 'component_type' => 'Technical Components', 'order' => 14],
            ['page_name' => 'Omnibus Sworn Statement', 'component_type' => 'Technical Components', 'order' => 15],
            ['page_name' => 'Letter of Intent', 'component_type' => 'Technical Components', 'order' => 16],
            ['page_name' => 'Technical Specifications', 'component_type' => 'Technical Components', 'order' => 17],
            ['page_name' => 'Organizational Chart', 'component_type' => 'Technical Components', 'order' => 18],
            ['page_name' => 'Production and Delivery Schedule', 'component_type' => 'Technical Components', 'order' => 19],
            ['page_name' => 'Man-Power Requirements', 'component_type' => 'Technical Components', 'order' => 20],
            ['page_name' => 'Equipment Requirements', 'component_type' => 'Technical Components', 'order' => 21],

            // FINANCIAL COMPONENTS
            ['page_name' => 'Cover Page', 'component_type' => 'Financial Components', 'order' => 1],
            ['page_name' => 'Notice to Bidders', 'component_type' => 'Financial Components', 'order' => 2],
            ['page_name' => 'Detailed Estimate', 'component_type' => 'Financial Components', 'order' => 3],
            ['page_name' => 'Cash Flow', 'component_type' => 'Financial Components', 'order' => 4],
            ['page_name' => 'Warranty and Price Validity', 'component_type' => 'Financial Components', 'order' => 5],
            ['page_name' => 'Brochure', 'component_type' => 'Financial Components', 'order' => 6],
            ['page_name' => 'Bid Forms for the Procurement of Goods', 'component_type' => 'Financial Components', 'order' => 7]
        ];

        foreach ($data as &$item) {
            $item['status'] = 1;
            $item['created_at'] = now();
            $item['updated_at'] = now();
        }

        DB::table('bid_tbl_pages')->insert($data);
    }
}

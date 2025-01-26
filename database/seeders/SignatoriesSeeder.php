<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Signatory;

class SignatoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $signatories = [
            ['Dr. Elmer B. Nuez, MD, JD', 'Chief Operating Executive'], 
            ['Roel Pagobo', 'Head Technician'], 
            ['Engr. M.C. Anden', 'Operation Manager']
        ];

        foreach ($signatories as $key => $signatory) {
            Signatory::create([
                'name' => $signatory[0],
                'position' => $signatory[1]
                ]);
        }
    }
}

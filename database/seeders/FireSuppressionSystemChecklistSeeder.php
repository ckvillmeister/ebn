<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FireSuppressionSystemChecklist;

class FireSuppressionSystemChecklistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $checklist = [
            "Are employees trained on extinguisher types and usage?",
            "Are employees aware of fire classifications (A, B, C, D, K)?",
            "Does the facility comply with NFPA 10: Standard for Portable Fire Extinguishers?",
            "Are extinguisher certification records maintained?",
            "Are fire extinguishers compatible with potential fire hazards?",
            "Are extinguishers suitable for the facility's occupancy type?",
            "Are fire extinguishers inspected monthly and annually?",
            "Are extinguishers easily accessible and visibly marked?",
            "Are employees trained on extinguisher usage?",
            "Are extinguishers properly mounted and secured?",
            "Are extinguishers installed at least 3-4 feet off the floor?",
            "Are extinguishers spaced 75 feet apart or less?",
            "Are extinguishers installed in areas with high fire hazards?",
            "Are extinguishers inspected by certified technicians?",
            "Are extinguishers recharged or replaced as needed?",
            "Are inspection records maintained?"
        ];

        foreach ($checklist as $key => $desc) {
            FireSuppressionSystemChecklist::create([
                "description" => $desc
                ]);
        }
    }
}

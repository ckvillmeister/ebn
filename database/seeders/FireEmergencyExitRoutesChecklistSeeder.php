<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FireEmergencyExitRoutesChecklist;

class FireEmergencyExitRoutesChecklistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $checklist = [
            'Are the labels on the fire doors clearly visible and legible?', 
            'Are there any obstruction to the fire door?',
            'Do all fire doors close securely without obstruction?',
            'Are the door closers in good condition and operating properly?',
            'Are all door gaps within NFPA acceptable limits?',
            'Are the seals around the doors in good condition?',
            'Are the doors free of damage or alterations the could compromise integrity?',
            'Are hold-open devices releasing when doors are pushed or pulled?',
            'Are fire exit hardware devices in good working order?',
            'Have all doors been checked for excessive force to open?',
            'Are the doors free of auxiliary hardware items that interfere with operation?',
            'Are the doors free of field modifications that void the label?',
            'Are the doors equipped with the correct type of fire exit hardware?',
            'Are the doors free from wedges or other objects preventing them from closing?',
            'Are all door frames and hardware components free from rust and damage?'
        ];

        foreach ($checklist as $key => $desc) {
            FireEmergencyExitRoutesChecklist::create([
                'description' => $desc,
                'status' => 1
                ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AssessmentCategory;
use App\Models\Assessment;
use App\Models\AssessmentResponses;

class AssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Fire Prevention Systems',
            'Emergency Exits and Routes',
            'Fire Extinguishers and Equipment',
            'Staff Training and Drills',
            'Compliance with Regulations'
        ];

        $questions = [
            1 => [
                'Do you have functional FDAS?',
                'Do you have functional Automatic Fire Sprinkler System or AFSS?'
            ],
            2 => [
                'Do you have Emergency Exits?',
                'Do you have Emergency Lights?'
            ],
            4 => [
                'Do you have Fire Drill Certificate?'
            ],
            5 => [
                'Were you able to comply with the Fire Safety Inspection Certificate (FSIC)?'
            ]
        ];

        $responses = [
            1 => [
                1 => 'The establishment is equipped with a modern fire alarm and detection system that undergoes regular testing and maintenance.',
                2 => 'The establishment is not equipped with a modern fire alarm and detection system that undergoes regular testing and maintenance.',
                3 => 'The establishment is equipped with a modern fire alarm and detection system that undergoes regular testing and maintenance but still to be repaired.'
            ],
            2 => [
                1 => 'The property boasts an automatic sprinkler system that covers all critical areas. Recent inspections indicated that sprinkler heads are clear of obstructions, and systems are functional.',
                2 => 'Sprinkler System: The property doesnt have an automatic sprinkler system that covers all critical areas.',
                3 => 'Sprinkler System: The property boasts an automatic sprinkler system that covers all critical areas. However, recent inspections indicated that sprinkler heads are to be cleared from obstructions, and systems are to be fixed.'
            ],
            3 => [
                1 => 'Clearly marked and accessible exits were available throughout the establishment, with some exits leading to restricted areas that could obstruct evacuation.',
                2 => 'No clear mark and accessible exits were available throughout the establishment that can be used for emergency evacuation.',
                3 => 'Clearly marked and accessible exits were under repair and soon to be available throughout the establishment, with some exits leading to restricted areas that could obstruct evacuation. The client has to provide.'
            ],
            4 => [
                1 => 'Emergency lighting on exit routes is operational. Emergency lighting ensures safe evacuation by illuminating exit paths and reducing panic during emergencies when normal lighting fails, helping both occupants and responders navigate safely. It is a critical component of fire protection that enhances overall safety and complies with safety regulations.',
                2 => 'No emergency lighting on exit routes is operational. No emergency lighting that ensures safe evacuation by illuminating exit paths and reducing panic during emergencies when normal lighting fails, helping both occupants and responders navigate safely. It is a critical component of fire protection that enhances overall safety and complies with safety regulations.',
                3 => 'Emergency lighting on exit routes is NOT operational. Emergency lighting ensures safe evacuation by illuminating exit paths and reducing panic during emergencies when normal lighting fails, helping both occupants and responders navigate safely. It is a critical component of fire protection that enhances overall safety and complies with safety regulations.'
            ],
            5 => [
                1 => 'Staff members reported having received fire extinguisher training, many can explain the PASS technique (Pull, Aim, Squeeze, Sweep) effectively.',
                2 => 'No staff members reported having received fire extinguisher training, many could not explain the PASS technique (Pull, Aim, Squeeze, Sweep) effectively.'
            ],
            6 => [
                1 => 'The establishment adheres to the local fire code and has passed its last inspection from the local fire authority. However, maintaining up-to-date documentation and certifications for all safety equipment needs attention.',
                2 => 'The establishment has not complied with the local fire code and has not passed its last inspection from the local fire authority. However, maintaining up-to-date documentation and certifications for all safety equipment needs attention.'
            ]
        ];

        //Loop through all categories
        foreach ($categories as $category){
            $categ_id = AssessmentCategory::create([
                'category' => $category
            ])->id;

            //Loop through all questions
            foreach ($questions as $question_key => $question){

                //Check if category matches with the question key
                if ($question_key == $categ_id){

                    //Loop through all questions per category
                    foreach ($question as $q){

                        //Create all questions per category
                        $question_id = Assessment::create([
                            'assessment_category' => $categ_id,
                            'question' => $q
                        ])->id;

                        //Loop through all responses
                        foreach ($responses as $response_key => $response){

                            //Check if question id matches with the response key
                            if ($question_id == $response_key){

                                //Loop through all responses per question id
                                foreach ($response as $r_key => $r){
                                    AssessmentResponses::create([
                                        'question_id' => $question_id,
                                        'response_type' => $r_key,
                                        'response' => $r
                                    ]);
                                }
                            }
                        }
                    }
                }
                
            }
        }
    }
}

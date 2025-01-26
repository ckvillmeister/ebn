<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recommendation;

class RecommendationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recommendations = [
                        [1, '•&nbsp;Conduct a Fire Risk Assessment: Hire a certified fire safety consultant to conduct a thorough assessment of the premises to identify potential fire hazards and recommend necessary prevention measures.<br>•&nbsp;Contact {name} and Install a Comprehensive Fire Alarm and Detection System: Invest in a modern fire alarm system that includes smoke detectors, heat detectors, and alarm notifications to alert occupants in case of fire.<br>•&nbsp;Implement Regular Maintenance and Inspections: Establish a routine schedule for checking and maintaining fire prevention equipment and systems to ensure they are functioning effectively, {name} can do this for you if you want.'],
                        [2, '•&nbsp;Clear and Mark Emergency Exits: Ensure all emergency exits are clearly marked with illuminated signs and are free of obstructions, making them accessible to all occupants at all times. {name} can provide subject to your approval.<br>•&nbsp;Develop an Evacuation Plan: Create a detailed evacuation plan that outlines exit routes and procedures, and distribute it to all staff members and occupants of the building.<br>•&nbsp;Conduct Regular Safety Inspections: Schedule regular inspections of all emergency exits and routes to ensure they are well-maintained and compliant with safety regulations.'],
                        [3, '•&nbsp;Evaluate the Number and Placement: Assess the current number and locations of fire extinguishers to ensure adequate coverage throughout the establishment according to the type of hazards present.<br>•&nbsp;Provide Employee Training on Use: Organize training sessions for employees on how to properly use fire extinguishers and respond to small fires, including hands-on practice where possible.<br>•&nbsp;Establish a Maintenance Schedule: Implement a routine maintenance and inspection schedule for fire extinguishers and other fire suppression equipment to ensure they are in working condition.'],
                        [4, '•&nbsp;Implement Regular Fire Safety Training: Schedule regular training sessions on fire safety protocols, emergency procedures, and equipment usage for all staff members.<br>•&nbsp;Conduct Fire Drills: Organize quarterly fire drills to ensure that all employees are familiar with evacuation procedures and can respond quickly and effectively in an emergency. You can contact {name} once your fire extinguisher is already used for a fire drill, that is empty already. It must be refilled immediately.<br>•&nbsp;Evaluate Training Effectiveness: After each training session or drill, gather feedback and conduct evaluations to continuously improve fire safety training programs.'],
                        [5, '•&nbsp;Review Relevant Fire Safety Regulations: Conduct a comprehensive review of local fire safety codes and regulations in your locality to identify areas of non-compliance and necessary actions for compliance.<br>•&nbsp;Engage with Fire Safety Experts: Consult with fire safety professionals or organizations such as {name} to receive guidance on how to meet regulatory requirements and enhance fire safety measures.<br>•&nbsp;Document Compliance Efforts: Keep detailed records of actions taken and compliance efforts made, including inspections, training, and maintenance, to demonstrate commitment to fire safety and compliance.'],
                    ];

    	foreach ($recommendations as $key => $recommendation) {
    		Recommendation::create([
					'assessment_category_id' => $recommendation[0],
                    'recommendation' => $recommendation[1]
					]);
    	}
    }
}

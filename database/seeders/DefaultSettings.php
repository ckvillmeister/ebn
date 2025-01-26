<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings;

class DefaultSettings extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
                        ['Certificate Template', 'certification', 'This is to certify that <b>{establishment_name}</b> has been satisfactorily comply the Fire Safety requirements which includes the Fire Detection (FDAS), Fire Suppression (Fire Extinguisher), Fire Exit & Egress and Emergency Power Supply and also included the periodical testing and commissioning and maintenance all are in accordance with the approved <em>Fire Safety System</em> of "{bfp}" for yearly period of {year}.<br><br>This certification is issued to <b>{establishment_name}</b> for whatever purpose it may serve him best.<br><br>Given this {date_issued} at <b>{establishment_name}</b> office, <b>{establishment_address}</b>.'],
                        ['Executive Summary Template', 'executive_summary', 'This Fire Safety Maintenance Report encompasses a comprehensive assessment of <b>{establishment_name}</b> Bldg. regarding its fire safety protocols and infrastructure. The evaluation considers the fire prevention systems, safety equipment, training of personnel, and adherence to applicable fire safety regulations. Based on the findings, recommendations are provided to enhance safety measures and reduce potential fire hazards within the establishment.'],
                        ['Fire Extinguisher Maintenance Reminder', 'fss_maintenance_reminder', "<b>Maintenance of Fire Extinguisher</b><br><br>An extinguisher isn't much good if it doesn't work properly when you need it to. Conduct regular inspections and maintenance to keep your fire extinguishers in good working condition. All portable fire extinguishers should undergo visual inspection on a monthly basis. Look for the following things:<br><br>- Extinguisher is in the correct place and isn’t blocked or hidden<br> - All extinguishers are correctly mounted in accordance with NFPA standards<br>- Extinguisher pressure gauges have adequate pressure readings<br>- Pin and seals are intact<br>- No visual signs of damage<br>- Nozzles are free of blockage<br><br>In addition to monthly visual inspections, employers should conduct testing and maintenance at least once per year. Record the date on which the equipment was services and keep the records in a safe place for one year."],
                        ['Fire Alarm Detection System Reminder', 'fdas_reminder', "<b>Conventional Fire Alarm System</b><br><br><b>NFPA Guidelines for Conventional Fire Alarm Systems</b><br>The NFPA, specifically NFPA 72: National Fire Alarm and Signaling Code, provides guidelines and standards for conventional fire alarm systems to ensure their effectiveness and reliability. Below are some key aspects of NFPA guidelines for conventional fire alarm systems:<br><b>- Design and Installation:</b> NFPA 72 provides detailed guidelines for the design and installation of conventional fire alarm systems. It includes information on device placement, wiring, and spacing to ensure that the system can effectively detect and alert occupants to a fire.<br><b>- Testing and Maintenance:</b> Regular testing and maintenance of conventional fire alarm systems are critical to their reliability. NFPA 72 outlines the testing procedures that should be conducted regularly and the records that should be maintained to document system performance.<br><b>- Notification Appliance Synchronization:</b> To prevent confusion during an emergency, NFPA 72 stipulates that notification appliances in the same area should be synchronized to produce a consistent and intelligible alert signal.<br><b>- Power Supply and Backup:</b> The code specifies that conventional fire alarm systems should have a reliable power supply and backup power source to ensure continuous operation in the event of a power failure.<br><b>- Monitoring and Response:</b> Some fire alarm systems are connected to monitoring services that can dispatch authorities in the event of an alarm. NFPA 72 provides guidelines for the connection and operation of these services.<br><b>- Documentation and Record Keeping:</b> The NFPA mandates the creation and maintenance of records that include installation, testing, maintenance, and inspection activities. These records are essential for ensuring the system’s integrity and compliance with regulations."],
                        ['Conclusion Template', 'conclusion', 'In conclusion, the Fire Safety Maintenance Report of {establishment_name} conducted by {name} highlights the critical areas where an establishment must improve its fire safety measures to ensure the safety of its occupants and protect property, if and only if recommendations were given above. Fortunately, by addressing deficiencies in the fire prevention system, emergency exits, fire extinguishers, staff training, and compliance with regulations, this establishment significantly enhanced its overall fire safety posture. Implementing the recommended actions above, if any, will not only foster a culture of safety and preparedness but also ensure compliance with legal requirements, ultimately reducing risks and liabilities associated with fire incidents. Proactive engagement in fire safety maintenance is essential for safeguarding lives and assets, making it imperative for management to prioritize and allocate necessary resources for ongoing improvements in fire safety practices. The Bureau of Fire Protection in your locality has the final instruction, approval, and recommendation subject to the rules and regulations of the Fire Code of the Philippines.<br>The overall fire safety measures at {establishment_name} are relatively robust, with existing systems in place. However, the identified gaps, if any, can pose risks that must be addressed. By implementing the above recommendations, if any, {establishment_name} can significantly improve its fire safety and preparedness, ensuring the safety of all occupants and compliance with regulations.<br><br>Congratulations {establishment_name}!'],
                        ['Recommendation Template', 'recommendation', 'Recommendations for establishing fire safety measures are crucial for several reasons. They provide expert guidelines and best practices that help organizations identify and mitigate fire hazards, ensuring the safety of occupants and property. Additionally, following recommendations fosters compliance with legal regulations and standards, enhances emergency preparedness, and promotes a culture of safety within the organization, ultimately reducing risks and potential liabilities.<br><br>The {name} recommends the following for the establishment to comply.'],
                        ['Name of Business', 'business_name', 'EBN Enterprises'],
                        ['Address', 'business_address', 'Poblacion, Trinidad, Bohol'],
                        ['Location', 'location', 'Sure Care Medical Clinic (beside Cebuana Lhuiller Pawnshop)'],
                        ['Contact Number:', 'number', '09097757284'],
                        ['DTI Number', 'dti', '05116267'],
                        ['BIR', 'bir', '2RC0001606835'],
                        ["Mayor's Permit", 'mo_permit', '2024-00438-0']
                    ];

    	foreach ($settings as $key => $setting) {
    		Settings::create([
                    'name' => $setting[0],
					'code' => $setting[1],
                    'description' => $setting[2]
					]);
    	}
    }
}

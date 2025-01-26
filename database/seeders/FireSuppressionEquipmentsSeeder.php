<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FireSuppressionEquipments;

class FireSuppressionEquipmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipments = [
                ['ABC Red Fire extinguisher Brand New',	'3kl'],
                ['ABC Red Fire Extinguisher Brand New',	'5kl'],
                ['ABC Red Fire Extinguisher Brand New',	'10kl'],
                ['ABC Red Fire Extinguisher Brand New',	'20kl'],
                ['ABC Red Fire Extinguisher Brand New',	'50kl'],
                ['HFC 236 FA Green (cylinder type)', '5kl'],
                ['HFC 236 FA Green (cylinder type)', '5kl up'],
                ['HFC 236 FA Green (ceiling)', '5kl'],
                ['HFC 236 FA Green (ceiling)', '5kl up'],
                ['AFFF Blue Fire Extinguisher', '5kl'],
                ['C02 Fire Extinguisher', '5kl'],
                ['C02 Fire Extinguisher', '10kl'],
                ['C02 Fire Extinguisher', '50kls'],
                ['Refill Red ABC', '3kgs'],
                ['Refill Red ABC', '5kgs'],
                ['Refill Red ABC', '10kgs'],
                ['Refill Red ABC', '10kgs UP'],
                ['Emergency light', 'Twin head']
        ];

        foreach ($equipments as $key => $equipment) {
            FireSuppressionEquipments::create([
                'item' => $equipment[0],
                'quantity' => $equipment[1]
                ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    	$permissions = [
						['Side Bar', 'View Dashboard'], 
    					['Side Bar', 'View Client'], 
						['Side Bar', 'New FSMR Application'], 
						['Side Bar', 'My FSMR Applications'], 
						['Side Bar', 'List of FSMRs'], 
    					['Side Bar', 'Attachment Types Manager'], 
    					['Side Bar', 'FSMR Contents Manager'], 
    					['Side Bar', 'Fire Detection Alarm System Manager'], 
						['Side Bar', 'Question Checklist Manager'], 
    					['Side Bar', 'Signatories Manager'], 
    					['Side Bar', 'Roles and Permission Manager'], 
    					['Side Bar', 'User Accounts Manager'],
    					['Side Bar', 'Defaults'],
						['Side Bar', 'Database Backup'], 
						['Side Bar', 'Overall Maintenance'], 
					];

    	foreach ($permissions as $key => $permission) {
    		Permission::create([
					'group' => $permission[0],
					'name' => $permission[1],
					'guard_name' => 'web',
					'created_at' => date('Y-m-d H:i:s')
					]);
    	}
		
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FireDoorMaintenanceCheckList;

class FSMREmergencyExitRoutes extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'fsmr_emergency_exit_routes';
    protected $fillable = [
        'fsmr_id',
        'checklist_id',
        'status',
        'remarks'
    ];

    public function description(){
        return $this->hasOne(FireDoorMaintenanceCheckList::class, 'id', 'checklist_id');
    }


}

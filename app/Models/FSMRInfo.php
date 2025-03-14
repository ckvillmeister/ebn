<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\FSMRAttachments;
use App\Models\FMSRFirePreventionSystem;
use App\Models\FSMREmergencyExitRoutes;
use App\Models\FSMRFireSuppressionSystem;
use App\Models\Signatory;
use App\Models\FSMRAssessment;
use App\Models\FSMRExtinguishersEquipment;
use App\Models\Town;

class FSMRInfo extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'fsmr_info';
    protected $fillable = [
        'app_no',
        'establishment_name',
        'establishment_address',
        'occupancy',
        'no_of_floors',
        'client_id',
        'processed_by',
        'date_processed',
        'reference_no',
        'building_use',
        'service_availed',
        'fps_manufacturer',
        'fps_model',
        'fps_circuit',
        'eer_manufacturer',
        'eer_hardware',
        'eer_remarks',
        'fss_inspection_date',
        'fss_unit',
        'fss_frequency',
        'fss_report',
        'fss_remarks',
        'technician',
        'inspector',
        'manager',
        'contractor',
        'assessment_fe_required',
        'assessment_fe_available',
        'assessment_fe_refilled',
        'addr_province',
        'addr_town',
        'status'
    ];

    public function client(){
        return $this->hasOne(User::class, 'id', 'client_id');
    }

    public function processor(){
        return $this->hasOne(User::class, 'id', 'processed_by');
    }

    public function attachments(){
        return $this->hasMany(FSMRAttachments::class, 'fsmr_id', 'id');
    }

    public function fps(){
        return $this->hasMany(FSMRFirePreventionSystem::class, 'fsmr_id', 'id');
    }

    public function eer(){
        return $this->hasMany(FSMREmergencyExitRoutes::class, 'fsmr_id', 'id');
    }

    public function fss(){
        return $this->hasMany(FSMRFireSuppressionSystem::class, 'fsmr_id', 'id');
    }

    public function assessments(){
        return $this->hasMany(FSMRAssessment::class, 'fsmr_id', 'id');
    }

    public function fee(){
        return $this->hasMany(FSMRExtinguishersEquipment::class, 'fsmr_id', 'id');
    }

    public function town(){
        return $this->belongsTo(Town::class, 'addr_town', 'code');
    }
}

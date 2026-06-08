<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BidTblAllOngoingProjects;
use App\Models\BidTblSingleLargestContracts;

class BidTblProject extends Model
{
    use HasFactory;

    protected $table = 'bid_tbl_projects';

    protected $fillable = [
        'project_reference_no',
        'project_identification_no',
        'project_name',
        'project_cost',
        'project_type',
        'agency_name',
        'agency_logo_url',
        'address',
        'contact_no',
        'system_components',
        'service_parts',
        'certifications',
        'nature_of_work',
        'bidder_role_desc',
        'bidder_role_percent',
        'date_awarded',
        'date_started',
        'date_of_completion',
        'percent_accomplishment_planned',
        'percent_accomplishment_actual',
        'value',
        'bid_securing_declaration_date',
        'omnibus_sworn_statement_date',
        'fc_proponent',
        'fc_warranty_calendar_days',
        'fc_product_to_be_supplied',
        'fc_warranty',
        'aogpc_date_signed',
        'slcc_date_signed',
        'status'
    ];

    public function aogpc(){
        return $this->hasMany(BidTblAllOngoingProjects::class, 'project_id', 'id');
    }

    public function slcc(){
        return $this->hasMany(BidTblSingleLargestContracts::class, 'project_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidTblAllOngoingProjects extends Model
{
    use HasFactory;
    protected $table = 'bid_tbl_all_ongoing_projects';

    protected $fillable = [
        // 'project_id',
        'name_of_contract',
        'project_cost',
        'project_type',
        'owner_name',
        'address',
        'telephone_no',
        'nature_of_work',
        'bidder_role_description',
        'bidder_role_percentage',
        'date_awarded',
        'date_started',
        'date_of_completion',
        'planned_percentage',
        'actual_percentage',
        'outstanding_works'
    ];
}

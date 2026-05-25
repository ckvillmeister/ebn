<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidTblSingleLargestContracts extends Model
{
    use HasFactory;

    protected $table = 'bid_tbl_single_largest_contracts';
    protected $fillable = [
        'project_id',
        'name_of_contract',
        'project_cost',
        'project_type',
        'owner_name',
        'address',
        'telephone_no',
        'nature_of_work',
        'bidder_role_description',
        'bidder_role_percentage',
        'amount_of_award',
        'amount_of_completion',
        'duration',
        'date_awarded',
        'contract_effectivity',
        'date_completed'
    ];
}

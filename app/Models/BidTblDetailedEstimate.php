<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidTblDetailedEstimate extends Model
{
    use HasFactory;

    protected $table = 'bid_tbl_detailed_estimates';

    protected $fillable = [
        'project_id',
        'description',
        'quantity',
        'unit',
        'unit_cost',
        'total_cost'
    ];
}

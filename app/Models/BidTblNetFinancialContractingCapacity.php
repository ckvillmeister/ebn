<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidTblNetFinancialContractingCapacity extends Model
{
    use HasFactory;

    protected $table = 'bid_tbl_net_financial_contracting_capacity';

    protected $fillable = [
        'project_id',
        'name',
        'year',
        'amount',
    ];
}

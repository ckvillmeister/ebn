<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidTblProjectDeliverySchedule extends Model
{
    use HasFactory;

    protected $table = 'bid_tbl_project_delivery_schedule';

    protected $fillable = [
        'project_id',
        'description',
        'schedule',
        'amount',
        'remarks'
    ];
}

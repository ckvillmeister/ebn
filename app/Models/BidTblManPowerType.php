<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidTblManPowerType extends Model
{
    use HasFactory;

    protected $table = 'bid_tbl_man_power_types';

    protected $fillable = [
        'name',
        'status'
    ];
}

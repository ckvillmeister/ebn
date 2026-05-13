<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidTblEquipments extends Model
{
    use HasFactory;

    protected $table = 'bid_tbl_tools_and_equipments';

    protected $fillable = [
        'name',
        'description',
        'type',
        'status'
    ];
}

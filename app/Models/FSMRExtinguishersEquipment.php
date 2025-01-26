<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FSMRExtinguishersEquipment extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'fsmr_extinguishers_equipment';
    protected $fillable = [
        'fsmr_id',
        'item',
        'quantity',
        'available',
        'required'
    ];
}

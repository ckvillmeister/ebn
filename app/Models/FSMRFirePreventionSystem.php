<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FSMRFirePreventionSystem extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'fsmr_fire_prevention_system';
    protected $fillable = [
        'fsmr_id',
        'item_id',
        'item_count',
        'circuit',
        'item_tested_count'
    ];
}

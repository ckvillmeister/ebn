<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FSMRFireSuppressionSystem extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'fsmr_fire_suppression_system';
    protected $fillable = [
        'fsmr_id',
        'checklist_id',
        'status',
        'remarks'
    ];
}

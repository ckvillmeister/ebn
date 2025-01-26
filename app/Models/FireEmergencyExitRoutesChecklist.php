<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FireEmergencyExitRoutesChecklist extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'fire_emergency_exit_routes_checklist';
    protected $fillable = [
        'description'
    ];
}

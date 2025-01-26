<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FireSuppressionSystemChecklist extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'fire_suppression_system_checklist';
    protected $fillable = [
        'description',
        'status'
    ];
}

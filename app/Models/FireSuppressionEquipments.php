<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FireSuppressionEquipments extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'fire_suppression_equipments';
    protected $fillable = [
        'item',
        'quantity',
        'status'
    ];
}

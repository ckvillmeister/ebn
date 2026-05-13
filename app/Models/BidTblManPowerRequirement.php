<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BidTblManPowerType;

class BidTblManPowerRequirement extends Model
{
    use HasFactory;

    protected $table = 'bid_tbl_man_power_requirements';

    protected $fillable = [
        'project_id',
        'man_power_type_id',
        'quantity',
        'task'
    ];

    public function type()
    {
        return $this->belongsTo(BidTblManPowerType::class, 'man_power_type_id');
    }
}

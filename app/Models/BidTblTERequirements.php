<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BidTblProject;
use App\Models\BidTblEquipments;

class BidTblTERequirements extends Model
{
    use HasFactory;

    protected $table = 'bid_tbl_project_te_requirement';

    protected $fillable = [
        'project_id',
        'tool_equipment_id',
        'quantity'
    ];

    public function project()
    {
        return $this->belongsTo(BidTblProject::class, 'project_id');
    }

    public function equipment()
    {
        return $this->belongsTo(BidTblEquipments::class, 'tool_equipment_id');
    }
}

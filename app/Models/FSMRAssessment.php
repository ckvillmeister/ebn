<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Assessment;

class FSMRAssessment extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'fsmr_assessments';
    protected $fillable = [
        'fsmr_id',
        'assessment_id',
        'response_type'
    ];

    public function question()
    {
        return $this->hasOne(Assessment::class, 'id', 'assessment_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AssessmentResponses;
use App\Models\AssessmentCategory;

class Assessment extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'assessments';
    protected $fillable = [
        'assessment_category',
        'question',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(AssessmentCategory::class, 'assessment_category', 'id');
    }

    public function responses()
    {
        return $this->hasMany(AssessmentResponses::class, 'question_id', 'id');
    }

    public function response_types()
    {
        return $this->hasMany(AssessmentResponses::class, 'question_id')
            ->select('response_type')
            ->groupBy('response_type');
    }

}

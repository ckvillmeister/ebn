<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AssessmentCategory;

class Recommendation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'recommendations';
    protected $fillable = [
        'assessment_category_id',
        'recommendation',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(AssessmentCategory::class, 'assessment_category_id', 'id');
    }
}

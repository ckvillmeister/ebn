<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentResponses extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'assessment_responses';
    protected $fillable = [
        'question_id',
        'response_type',
        'response'
    ];
}

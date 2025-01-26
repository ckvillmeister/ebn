<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentCategory extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'assessment_categories';
    protected $fillable = [
        'category',
        'status'
    ];
}

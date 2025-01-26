<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FSMRSubContents;

class FSMRContent extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'fsmr_content';
    protected $fillable = [
        'description',
    ];

    public function subcontents(){
        return $this->hasMany(FSMRSubContents::class, 'content_id', 'id');
    }
}

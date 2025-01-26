<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AttachmentTypes;

class FSMRSubContents extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'fsmr_sub_contents';
    protected $fillable = [
        'content_id',
        'attachment_type_id'
    ];

    public function attachment_type(){
        return $this->hasOne(AttachmentTypes::class, 'id', 'attachment_type_id');
    }
}

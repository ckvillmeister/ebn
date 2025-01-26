<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AttachmentTypes;

class FSMRAttachments extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'fsmr_attachments';
    protected $fillable = [
        'fsmr_id',
        'attachment_type_id',
        'url'
    ];

    public function attachmenttype(){
        return $this->hasOne(AttachmentTypes::class, 'id', 'attachment_type_id');
    }
}

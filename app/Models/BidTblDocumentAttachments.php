<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidTblDocumentAttachments extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'bid_tbl_document_attachments';

    protected $fillable = [
        'project_id',
        'attachment_type',
        'image_url'
    ];
}

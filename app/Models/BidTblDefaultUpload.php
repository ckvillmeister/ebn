<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\BidTblDefaultUploadType;

class BidTblDefaultUpload extends Model
{
    use HasFactory;

    protected $table = 'bid_tbl_default_uploads';

    protected $fillable = [
        'upload_type_id',
        'image_url',
        'is_active',
        'status'
    ];

    public function uploadType(): BelongsTo
    {
        return $this->belongsTo(BidTblDefaultUploadType::class, 'upload_type_id', 'id');
    }
}

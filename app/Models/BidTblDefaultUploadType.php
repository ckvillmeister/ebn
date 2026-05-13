<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\BidTblDefaultUpload;

class BidTblDefaultUploadType extends Model
{
    use HasFactory;

    protected $table = 'bid_tbl_default_upload_types';

    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    public function defaultUploads(): HasMany
    {
        // Define the one-to-many relationship
        return $this->hasMany(BidTblDefaultUpload::class, 'upload_type_id', 'id');
    }


}

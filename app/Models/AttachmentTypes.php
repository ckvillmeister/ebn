<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachmentTypes extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'attachment_types';
    protected $fillable = [
        'description',
    ];
}

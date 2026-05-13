<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidTblPages extends Model
{
    use HasFactory;

    protected $table = 'bid_tbl_pages';

    protected $fillable = [
        'page_name',
        'component_type',
        'order',
        'status'
    ];
}

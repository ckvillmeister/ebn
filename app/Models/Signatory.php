<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signatory extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'signatories';
    protected $fillable = [
        'name',
        'position',
        'is_approving_officer',
        'status'
    ];
}

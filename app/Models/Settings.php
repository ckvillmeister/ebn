<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'default_settings';
    protected $fillable = [
        'name',
        'code',
        'description'
    ];
}

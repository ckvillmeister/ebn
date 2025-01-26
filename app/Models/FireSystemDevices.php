<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FireSystemDeviceCategories;

class FireSystemDevices extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'fire_system_devices';
    protected $fillable = [
        'category_id',
        'name'
    ];

    public function category()
    {
        return $this->belongsTo(FireSystemDeviceCategories::class, 'category_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FireSystemDevices;

class FireSystemDeviceCategories extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'fire_system_device_categories';
    protected $fillable = [
        'category',
    ];

    public function devices($status = 1){
        return $this->hasMany(FireSystemDevices::class, 'category_id', 'id')->where('status', $status);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barangay;
use App\Models\Town;
use App\Models\Province;

class Client extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'username',
        'password',
        'role',
        'sex',
        'purok',
        'barangay',
        'municipality',
        'province',
        'contact_number',
        'email',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'status'
    ];

    public function barangay(){
        return $this->hasOne(Barangay::class, 'code', 'barangay');
    }

    public function town(){
        return $this->hasOne(Town::class, 'code', 'municipality');
    }

    public function province(){
        return $this->hasOne(Province::class, 'code', 'province');
    }
}

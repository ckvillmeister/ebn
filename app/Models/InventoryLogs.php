<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class InventoryLogs extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'inventory_logs';
    protected $fillable = [
        'product_id',
        'action',
        'quantity',
        'processed_by',
        'date_processed'
    ];

    public function processed_by(){
        return $this->hasOne(User::class, 'id', 'processed_by');
    }
}

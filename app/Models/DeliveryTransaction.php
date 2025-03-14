<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DeliveredItems;
use App\Models\User;

class DeliveryTransaction extends Model
{
    use HasFactory;

    protected $table = 'delivery_transactions';
    public $timestamps = false;
    protected $fillable = [
        'code',
        'delivery_date',
        'processed_by',
        'date_processed',
        'status',
    ];

    public function products(){
        return $this->hasMany(DeliveredItems::class, 'delivery_transaction_id', 'id');
    }

    public function processedBy(){
        return $this->hasOne(User::class, 'id', 'processed_by');
    }
}

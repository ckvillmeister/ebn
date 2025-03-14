<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;
use App\Models\Town;

class DeliveredItems extends Model
{
    use HasFactory;

    protected $table = 'delivered_items';
    public $timestamps = false;
    protected $fillable = [
        'delivery_transaction_id',
        'product_id',
        'location',
        'quantity'
    ];

    public function productInfo()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

    public function town(){
        return $this->hasOne(Town::class, 'code', 'location');
    }
}

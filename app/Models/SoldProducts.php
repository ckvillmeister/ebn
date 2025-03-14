<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;
use App\Models\Town;

class SoldProducts extends Model
{
    use HasFactory;

    protected $table = 'sold_products';
    public $timestamps = false;
    protected $fillable = [
        'sale_transaction_id',
        'product_id',
        'location',
        'quantity',        
        'price'
    ];

    public function productInfo()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

    public function town(){
        return $this->hasOne(Town::class, 'code', 'location');
    }
}

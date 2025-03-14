<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;
use App\Models\Town;

class ProductInventory extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'product_inventory';
    protected $fillable = [
        'product_id',
        'location_id',
        'stocks',
    ];

    public function productInfo(){
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

    public function location(){
        return $this->belongsTo(Town::class, 'location_id', 'code');
    }
}

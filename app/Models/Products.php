<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductInventory;
use App\Models\InventoryLogs;

class Products extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'products';
    protected $fillable = [
        'code',
        'name',
        'description',
        'brand',
        'uom',
        'price',
        'category',
        'status'
    ];

    public function inventory(){
        return $this->hasMany(ProductInventory::class, 'product_id', 'id');
    }

    public function inventory_logs(){
        return $this->hasMany(InventoryLogs::class, 'product_id', 'id');
    }


}

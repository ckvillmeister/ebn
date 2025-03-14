<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SoldProducts;

class SalesTransaction extends Model
{
    use HasFactory;

    protected $table = 'sales_transactions';
    public $timestamps = false;
    protected $fillable = [
        'code',
        'transaction_date',
        'processed_by',
        'date_processed',
        'status',
    ];

    public function products(){
        return $this->hasMany(SoldProducts::class, 'sale_transaction_id', 'id');
    }

    public function processedBy(){
        return $this->hasOne(User::class, 'id', 'processed_by');
    }
}

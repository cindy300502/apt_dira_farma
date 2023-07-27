<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Category;
use App\Models\SellingTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionProduct extends Model
{
    use HasFactory;

    protected $table = 'transaction_products';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'id_penjualan',
        'id_produk',
        'total_item',
    ];

    public function selling_transaction()
    {
        return $this->belongsTo(SellingTransaction::class, 'id_penjualan', 'id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'id_produk');
    }

    public function category()
    {
        return $this->hasOneThrough(
            Category::class,
            Product::class,
            'id',
            'id',
            'id_produk',
            'id_kategori',
        );
    }


}

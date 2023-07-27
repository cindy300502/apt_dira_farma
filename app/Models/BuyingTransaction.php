<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\ProductBrand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BuyingTransaction extends Model
{
    use HasFactory;

    protected $table = 'buying_transactions';

    protected $fillable = [
        'id_supplier',
        'id_produk',
        'id_brand',
        'total_item',
        'harga',
    ];

    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'id', 'id_supplier');
    }
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'id_produk');
    }
    public function product_brand()
    {
        return $this->hasOne(ProductBrand::class, 'id', 'id_brand');
    }


}

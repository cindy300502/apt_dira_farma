<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductBrand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'id_kategori',
        'id_brand',
        'nama_produk',
        'harga_jual',
        'stok',
        'expired',
        'deskripsi',
        'foto',
        'tipe',
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'id_kategori');
    }

    public function brand() {
        return $this->hasOne(ProductBrand::class, 'id', 'id_brand');
    }

}

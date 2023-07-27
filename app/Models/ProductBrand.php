<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductBrand extends Model
{
    use HasFactory;
    
    protected $table = 'product_brands';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'nama_merk',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'id_brand', 'id');
    }

}

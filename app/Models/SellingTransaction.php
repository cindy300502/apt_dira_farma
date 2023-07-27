<?php

namespace App\Models;

use App\Models\User;
use App\Models\TransactionProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SellingTransaction extends Model
{
    use HasFactory;

    protected $table = 'selling_transactions';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'id_user',
        'sub_total',
        'diskon',
        'dibayarkan',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function transaction_product()
    {
        return $this->hasMany(TransactionProduct::class, 'id_penjualan', 'id');
    }

}

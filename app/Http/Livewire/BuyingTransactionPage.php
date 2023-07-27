<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Supplier;
use App\Models\ProductBrand;
use App\Models\BuyingTransaction;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class BuyingTransactionPage extends Component
{
    // Binding Variable
    public $id_supplier;
    public $id_produk;
    public $id_brand;
    public $total_item;
    public $harga;

    // Model Variable
    public $Supplier;
    public $Product;
    public $Brand;

    protected $rules = [
        'id_supplier' => 'required',
        'id_produk' => 'required',
        'id_brand' => 'required',
        'total_item' => 'required|numeric|min:0',
        'harga' => 'required|numeric',
    ];

    public function mount(){
        $this->id_supplier = '';
        $this->id_produk = '';
        $this->total_item = '';
        $this->harga = '';

        $this->Supplier = Supplier::get();
        $this->Product = Product::get();
        $this->Brand = ProductBrand::get();
    }

    public function render()
    {
        return view('livewire.buying-transaction-page')->layout('layouts.admin_layout');
    }

    public function store_transaction() {
        $this->validate();

        // Store Transaction
        $BuyingTransaction = new BuyingTransaction;
        $BuyingTransaction->id = IdGenerator::generate(
            [
                'table' => 'buying_transactions',
                'length' => '14',
                'prefix' => 'in-'.date('ymd'),
            ]
        );
        $BuyingTransaction->id_supplier = $this->id_supplier;
        $BuyingTransaction->id_produk = $this->id_produk;
        $BuyingTransaction->id_brand = $this->id_brand;
        $BuyingTransaction->total_item = $this->total_item;
        $BuyingTransaction->harga = $this->harga;
        $BuyingTransaction->save();

        $updateProduct = Product::find($this->id_produk);
        $updateProduct->stok = (int)$updateProduct->stok + (int)$this->total_item;
        $updateProduct->save();

        $this->id_supplier = '';
        $this->id_produk = '';
        $this->total_item = '';
        $this->harga = '';

        $msg = 'Transaksi pembelian berhasil tersimpan';
        $this->dispatchBrowserEvent('setNotification', ['message' => $msg]);
        $this->emitTo('buying-transaction-table', 'reloadTable');
    }
}

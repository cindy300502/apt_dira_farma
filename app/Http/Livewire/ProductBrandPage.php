<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductBrand;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ProductBrandPage extends Component
{
    // Binding Variable
    public $name;

    protected $rules = [
        'name' => 'required|string'
    ];

    public function mount() {
        $this->name = '';
    }

    public function render()
    {
        return view('livewire.product-brand-page')->layout('layouts.admin_layout');
    }

    public function store_brand() {
        $this->validate();
        
        $Brand = new ProductBrand;
        $Brand->id = IdGenerator::generate(
            [
                'table' => 'product_brands',
                'length' => '14',
                'prefix' => 'mrk-'.date('ymd'),
            ]
        );
        $Brand->nama_merk = $this->name;
        $Brand->save();

        $msg = 'Brand berhasil diubah';
        $this->dispatchBrowserEvent('setNotification', ['message' => $msg]);
        $this->name = '';
        $this->emitTo('product-brand-table', 'reloadTable');

    }

}

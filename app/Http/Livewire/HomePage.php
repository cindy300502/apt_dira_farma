<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\SellingTransaction;

class HomePage extends Component
{
    // Binding Variable
    public $stock_count;
    public $expired_count;
    public $sales_count;

    public function mount() {
        $this->stock_count = Product::where('stok', '<=', 10)->get()->count();
        
        $last_month = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
        $this->sales_count = SellingTransaction::where('created_at', '>=', $last_month)->get()->count();;
        
        $expired_month = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "+3 month" ) );
        $this->expired_count = Product::where('expired', '<=', $expired_month)->get()->count();
    }

    public function render()
    {
        return view('livewire.home-page')->layout('layouts.admin_layout');
    }

    

}


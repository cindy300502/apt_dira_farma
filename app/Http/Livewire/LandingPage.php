<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class LandingPage extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    // Binding Model
    // protected $Products;

    public $search_filter;

    public $filter;

    public function updatedFilter() {
        $this->resetPage();
    }

    public function mount() {
        $this->filter = '';
        // $this->Products = Product::with(['category', 'brand'])->paginate(2);

    }
    
    public function render()
    {
        if ($this->filter) {
            $Products = Product::with(['category', 'brand'])->where('nama_produk', 'LIKE', '%'.$this->filter.'%')->paginate(10);
        } else {
            $Products = Product::with(['category', 'brand'])->paginate(10);
        }

        return view('livewire.landing-page', ['Products' => $Products])->layout('layouts.landing_layout');
    }

    public function getDetail($product) {
        $this->dispatchBrowserEvent('open-modal', [$product]);
    }


}

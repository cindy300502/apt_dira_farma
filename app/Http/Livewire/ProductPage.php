<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\ProductBrand;
use Livewire\WithFileUploads;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ProductPage extends Component
{
    use WithFileUploads;

    // Binding Variable
    public $name;
    public $harga_jual;
    public $category_id;
    public $stok;
    public $expired;
    public $brand_id;
    public $description;
    public $picture;
    public $type;

    public $name_edit;
    public $harga_jual_edit;
    public $category_id_edit;
    public $stok_edit;
    public $expired_edit;
    public $brand_id_edit;

    // Model Variable
    public $ProductEdit;
    public $ProductBrands;
    public $Categories;

    protected $rules = [
        'name' => 'required|string',
        'harga_jual' => 'required|integer',
        'category_id' => 'required',
        'stok' => 'required|integer',
        'expired' => 'required|date',
        'description' => 'nullable',
        'picture' => 'nullable|image',
        'type' => 'required',
    ];

    protected $listeners = [
        'editProduct' => 'stateEditProduct'
    ];

    public function stateEditProduct($id) {
        $this->ProductEdit = Product::find($id);
        if ($this->ProductEdit) {
            $this->name_edit = $this->ProductEdit->nama_produk;
            $this->brand_edit = $this->ProductEdit->brand;
            $this->harga_jual_edit = $this->ProductEdit->harga_jual;
            $this->category_id_edit = $this->ProductEdit->id_kategori;
            $this->stok_edit = $this->ProductEdit->stok;
            $this->expired_edit = $this->ProductEdit->expired;
        }
    }

    public function edit_product() {
        $this->validate([
            'name_edit' => 'required|string',
            'harga_jual_edit' => 'required|integer',
            'category_id_edit' => 'required',
            'stok_edit' => 'required|integer',
            'expired_edit' => 'required|date',
        ]);
        if ($this->ProductEdit) {
            $this->ProductEdit->nama_produk = $this->name_edit;
            $this->ProductEdit->harga_jual = $this->harga_jual_edit;
            $this->ProductEdit->id_kategori = $this->category_id_edit;
            $this->ProductEdit->stok = $this->stok_edit;
            $this->ProductEdit->expired = $this->expired_edit;
            $this->ProductEdit->save();

            $this->name_edit = '';
            $this->harga_jual_edit = '';
            $this->category_id_edit = '';
            $this->stok_edit ='';
            $this->expired_edit ='';
        
    
            $this->ProductEdit = null;

            $msg = 'Data product berhasil diubah';
            $this->dispatchBrowserEvent('setNotification', ['message' => $msg]);
            $this->emitTo('products-table', 'reloadTable');
        }
    }

    public function mount() {
        $this->name = '';
        $this->harga_jual = '';
        $this->category_id = '';
        $this->stok = '';
        $this->expired = '';
        $this->brand_id = '';
        $this->ProductEdit = null;
        $this->description = '';
        $this->picture = null;
        $this->type = '';

        $this->Categories = Category::get();
        $this->ProductBrands = ProductBrand::get();
    }

    public function render()
    {
        return view('livewire.product-page')->layout('layouts.admin_layout');
    }

    public function store_product() {
        $this->validate();
        
        $Product = new Product;
        $Product->id = IdGenerator::generate(
            [
                'table' => 'products',
                'length' => '14',
                'prefix' => 'prd-'.date('ymd'),
            ]
        );
        $Product->id_kategori = $this->category_id;
        $Product->id_brand = $this->brand_id;
        $Product->tipe = $this->type;
        $Product->nama_produk = $this->name;
        $Product->harga_jual = $this->harga_jual;
        $Product->stok = $this->stok;
        $Product->expired = $this->expired;
        $Product->deskripsi = $this->description;
        
        // Store picture
        if ($this->picture) {
            $picture_path = $this->picture->store('product');
            $Product->foto = $picture_path;
        }
    
        $Product->save();

        $this->name = '';
        $this->harga_jual = '';
        $this->category_id = '';
        $this->stok = '';
        $this->expired = '';
        $this->description = '';
        $this->picture = null;

        $msg = 'Produk berhasil tersimpan';
        $this->dispatchBrowserEvent('setNotification', ['message' => $msg]);
        $this->emitTo('products-table', 'reloadTable');
    }

}





<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\SellingTransaction;
use App\Models\TransactionProduct;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class TransactionPage extends Component
{
    // Model Variable
    public $Product;

    // Binding Variable;
    public $selected_product;
    public $selected_product_ids;
    public $subTotal;
    public $discount;
    public $discount_price;
    public $payment;

    public function updatedDiscount() {
        $this->validate();
        $this->discount_price = $this->subTotal * ((int) $this->discount / 100);
        $this->payment = (int) $this->subTotal - (int) $this->discount_price;
    }


    protected $rules = [
        'discount' => 'numeric|min:0|max:100'
    ];

    // Listeners
    protected $listeners = ['addProduct' => 'addProduct'];

    private function searchProductId(&$array, $id) {
        foreach ($array as $key => $element) {
            if (isset($element['id']) && $element['id'] == $id) {
                return [
                    'key' => $key,
                    'elem' => $element
                ];
            }
        }
        return false;
    }

    public function getPrice($product_id) {
        return Product::find($product_id)->harga_jual;
    }

    public function addProduct($id) {
        $productSearch = $this->searchProductId($this->selected_product, $id);
        if ( $productSearch != false ){
            $findKey = $productSearch['key'];
            $findQty = $productSearch['elem']['qty'];
            $this->selected_product[$findKey]['qty'] = $findQty + 1;
        } else {
            array_push($this->selected_product, [
                'id' => $id,
                'price' => $this->getPrice($id),
                'qty' => 1,
            ]);
        }
        array_push($this->selected_product_ids, $id);
        
        $this->subTotal = $this->calculateSubTotal();
        $this->payment = (int) $this->subTotal - (int) $this->discount_price;
        
        $msg = 'Produk ditambahkan';
        $this->dispatchBrowserEvent('setNotification', ['message' => $msg]);
    }

    public function mount() {
        $this->Product = Product::with(['category', 'brand'])->get();

        $this->selected_product = [];
        $this->selected_product_ids = [];
        $this->subTotal = 0;
        $this->discount = 0;
        $this->discount_price = 0;
        $this->payment = 0;
    }

    public function render()
    {
        return view('livewire.transaction-page')->layout('layouts.admin_layout');
    }

    public function create_transaction() {
        $SellingTransaction = new SellingTransaction;
        $SellingTransaction->id = IdGenerator::generate(
            [
                'table' => 'selling_transactions',
                'length' => '14',
                'prefix' => 'out-'.date('ymd'),
            ]
        );
        $SellingTransaction->id_user = Auth::user()->id;
        $SellingTransaction->dibayarkan = $this->payment;
        $SellingTransaction->diskon = $this->discount;
        $SellingTransaction->sub_total = $this->subTotal;
        $SellingTransaction->save();

        foreach ($this->selected_product as $product) {
            $TransactionProduct = new TransactionProduct;
            $TransactionProduct->id = IdGenerator::generate(
                [
                    'table' => 'transaction_products',
                    'length' => '14',
                    'prefix' => 'tpr-'.date('ymd'),
                ]
            );
            $TransactionProduct->id_penjualan = $SellingTransaction->id;
            $TransactionProduct->id_produk = $product['id'];
            $TransactionProduct->total_item = $product['qty'];
            $TransactionProduct->save();
        }

        // update stock product
        foreach ($this->selected_product as $product) {
            $updateProduct = Product::where('id', '=', $product['id'])->first();
            if ($updateProduct) {
                $updateProduct->stok = (int) $updateProduct->stok - (int) $product['qty'];
                $updateProduct->save();
            }
        }

        $msg = 'Transaksi Dibuat';
        $this->dispatchBrowserEvent('setNotification', ['message' => $msg]);

        $this->selected_product = [];
        $this->selected_product_ids = [];
        $this->subTotal = 0;
        $this->discount = 0;
        $this->discount_price = 0;
        $this->payment = 0;

    }

    private function deleteSelectedId(&$array, $value) {
        if (($key = array_search($value, $array)) !== false) {
            unset($array[$key]);
            return true;
        }
        return false;
    }

    private function deleteSelectedProduct(&$array, $id) {
        foreach ($array as $key => $element) {
            if (isset($element['id']) && $element['id'] == $id) {
                unset($array[$key]);
                return true;
            }
        }
        return false;
    }

    public function delete_selected($id) {
        dd($id);
        $this->deleteSelectedId($this->selected_product_ids, $id);
        $this->deleteSelectedProduct($this->selected_product, $id);
    }

    public function setQty($product, $qty) {
        $product_id = $product['id'];
        $productSearch = $this->searchProductId($this->selected_product, $product_id);
        $this->selected_product[$productSearch['key']]['qty'] = (int)$qty;
    }

    public function getQty($product_id) {
        $productSearch = $this->searchProductId($this->selected_product, $product_id);
        $productSearchKey = $productSearch['key'];
        return (int)$this->selected_product[$productSearchKey]['qty'];
    }

    public function calculateTotal($price, $qty) {
        $this->subTotal = $this->calculateSubTotal();
        return $price * $qty;
    }

    public function calculateSubTotal() {
        $subTotal = 0;
        foreach ($this->selected_product as $product) {
            $price = $product['price'];
            $qty = $product['qty'];
            $calculated = (int)$price * (int)$qty;    
            $subTotal += $calculated;
        }
        return $subTotal;
    }

}

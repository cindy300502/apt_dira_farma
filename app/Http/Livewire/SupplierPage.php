<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Supplier;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class SupplierPage extends Component
{
    public $name;
    public $alamat;
    public $no_telepon;
    
    public $name_edit;
    public $alamat_edit;
    public $no_telepon_edit;

    // Model Binding Variable
    public $SupplierEdit;

    protected $rules = [
        'name' => 'required|string',
        'alamat' => 'required|string',
        'no_telepon'=> 'required|numeric',
    ];

    // Listeners
    protected $listeners = [
        'editSupplier' => 'stateEditSupplier'
    ];

    public function stateEditSupplier($id) {
        $this->SupplierEdit = Supplier::find($id);
        if ($this->SupplierEdit) {
            $this->name_edit = $this->SupplierEdit->nama_supplier;
            $this->alamat_edit = $this->SupplierEdit->alamat;
            $this->no_telepon_edit = $this->SupplierEdit->no_telepon;
        }
    }

    public function edit_supplier() {
        $this->validate([
            'name_edit' => 'required|string',
            'alamat_edit' => 'required|string',
            'no_telepon_edit' => 'required|numeric',
        ]);
        if ($this->SupplierEdit) {
            $this->SupplierEdit->nama_supplier = $this->name_edit;
            $this->SupplierEdit->alamat = $this->alamat_edit;
            $this->SupplierEdit->no_telepon = $this->no_telepon_edit;
            $this->SupplierEdit->save();

            $this->name_edit = '';
            $this->alamat_edit = '';
            $this->no_telepon_edit = '';
    
            $this->SupplierEdit = null;

            $msg = 'Data supplier berhasil diubah';
            $this->dispatchBrowserEvent('setNotification', ['message' => $msg]);
            $this->emitTo('supplier-table', 'reloadTable');
        }
    }

    public function mount() {
        $this->name = '';
        $this->alamat = '';
        $this->no_telepon = '';
        
        $this->name_edit = '';
        $this->alamat_edit = '';
        $this->no_telepon_edit = '';

        $this->SupplierEdit = null;
    }
    
    public function render()
    {
        return view('livewire.supplier-page')->layout('layouts.admin_layout');
    }

    public function store_supplier() {
        $this->validate();

        $supplier = new Supplier;
        $supplier->id = IdGenerator::generate(
            [
                'table' => 'supplier',
                'length' => '14',
                'prefix' => 'sup-'.date('ymd'),
            ]
        );
        $supplier->nama_supplier = $this->name;
        $supplier->alamat = $this->alamat;
        $supplier->no_telepon = $this->no_telepon;
        $supplier->save();

        $this->name = '';
        $this->alamat = '';
        $this->no_telepon = '';
        
        $msg = 'Supplier berhasil tersimpan';
        $this->dispatchBrowserEvent('setNotification', ['message' => $msg]);
        $this->emitTo('supplier-table', 'reloadTable');
    }

}

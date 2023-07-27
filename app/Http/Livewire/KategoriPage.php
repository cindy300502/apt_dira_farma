<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class KategoriPage extends Component
{
    // Binding Variable
    public $name;
    public $description;
    public $name_edit;
    public $description_edit;

    // Model Variable
    public $CategoryEdit;

    // Listeners
    protected $listeners = [
        'editCategory' => 'stateEditCategory'
    ];

    public function stateEditCategory($id) {
        $this->CategoryEdit = Category::find($id);
        if ($this->CategoryEdit) {
            $this->name_edit = $this->CategoryEdit->nama_kategori;
            $this->description_edit = $this->CategoryEdit->deskripsi;
        }
    }

    public function edit_category() {
        $this->validate([
            'name_edit' => 'required|string',
            'description_edit' => 'nullable',
        ]);

        if ($this->CategoryEdit) {
            $this->CategoryEdit->nama_kategori = $this->name_edit;
            $this->CategoryEdit->deskripsi = $this->description_edit;
            $this->CategoryEdit->save();

            $this->name_edit = '';
            $this->description_edit = '';
            $this->CategoryEdit = null;

            $msg = 'Kategori berhasil diubah';
            $this->dispatchBrowserEvent('setNotification', ['message' => $msg]);
            $this->emitTo('categories-table', 'reloadTable');
        }
    }


    protected $rules = [
        'name' => 'required|string',
        'description' => 'nullable',
    ];

    public function mount() {
        $this->name = '';
        $this->description = '';
        
        $this->CategoryEdit = null;
    }

    public function render()
    {
        return view('livewire.kategori-page')->layout('layouts.admin_layout');
    }

    public function store_category() {
        $this->validate();

        $category = new Category;
        
        $category->id = IdGenerator::generate(
            [
                'table' => 'categories',
                'length' => '14',
                'prefix' => 'ctr-'.date('ymd'),
            ]
        );
        $category->nama_kategori = $this->name;
        $category->deskripsi = $this->description;
        $category->save();

        $this->name = '';
        $this->description = '';
        
        $msg = 'Kategori berhasil tersimpan';
        $this->dispatchBrowserEvent('setNotification', ['message' => $msg]);
        $this->emitTo('categories-table', 'reloadTable');


    }

}
<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class ProductsTable extends PowerGridComponent
{
    use ActionButton;
    
    // Listeners
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(), 
            [
                'deleteProduct'   => 'deleteProduct',
                'reloadTable'   => 'reloadTable',
                'sendEditState'   => 'sendEditState',
            ]);
    }
    public function deleteProduct($data) {
        $Product = Product::find($data['id']);
        if ($Product) {
            $Product->delete();
            $this->fillData();
        }
    }
    public function reloadTable() {
        $this->fillData();
    }
    public function sendEditState($data) {
        $product_id = $data['id'];
        $this->emitTo('product-page', 'editProduct', $product_id);
    }
    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Product::with(['category', 'brand']);
    }

    public function relationSearch(): array
    {
        return [
            'category' => ['nama_kategori'],
            'brand' => ['nama_merk'],
        ];

    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('kategori', fn (Product $model) => $model->category->nama_kategori)
            ->addColumn('nama_produk')
            ->addColumn('merk', fn (Product $model) => $model->brand->nama_merk)
            ->addColumn('harga_jual')
            ->addColumn('stok')
            ->addColumn('expired')
            ->addColumn('tipe')
            ->addColumn('created_at')
            ->addColumn('created_at_formatted', fn (Product $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable(),

            Column::make('Nama Kategori', 'kategori')
                ->searchable(),

            Column::make('Nama Produk', 'nama_produk')    
                ->searchable(),
    
            Column::make('Tipe', 'tipe')    
                ->searchable(),
    
            Column::make('Merk', 'merk')    
                ->searchable(),
    
            Column::make('Harga Jual', 'harga_jual')    
                ->searchable()
                ->sortable(),
    
            Column::make('Stok', 'stok')    
                ->sortable(),
    
            Column::make('Expired', 'expired')    
                ->sortable(),
    
            Column::make('Created at', 'created_at')
                ->hidden(),
                
            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->searchable()
                ->hidden(),
        ];
    }

    public function filters(): array
    {
        return [
            // Filter::inputText('name'),
            // Filter::datepicker('created_at_formatted', 'created_at'),
        ];
    }


    
    public function actions(): array
    {
       return [
           Button::make('delete', 'Hapus')
                ->class('btn btn-danger')
                ->emit('deleteProduct', ['id' => 'id']),
           Button::make('edit', 'Edit')
                ->class('btn btn-info')
                ->emit('sendEditState', ['id' => 'id']),
        ];
    }
    

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Product Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($product) => $product->id === 1)
                ->hide(),
        ];
    }
    */
}

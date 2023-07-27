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

final class SellingProductsTable extends PowerGridComponent
{
    use ActionButton;

    // Listeners
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(), 
            [
                'addToSelected'   => 'sendSelectedProductId',
                'reloadTable'   => 'reloadTable',
                'sendEditState'   => 'sendEditState',
            ]);
    }
    public function reloadTable() {
        $this->fillData();
    }
    public function sendSelectedProductId($data) {
        $id = $data['id'];
        $this->emitTo('transaction-page', 'addProduct', $id);
    }
    

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
        return Product::with(['category', 'brand'])->where([
            ['stok', '>=', 10],
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [
            'category' => ['nama_kategori'],
            'brand' => ['nama_merk'],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('kategori', fn (Product $model) => $model->category->nama_kategori)
            ->addColumn('nama_produk')
            ->addColumn('merk', fn (Product $model) => $model->brand->nama_merk)
            ->addColumn('harga_jual')
            ->addColumn('harga_jual_formatted', fn (Product $model) => formatRupiah($model->harga_jual))
            ->addColumn('stok')
            ->addColumn('expired')
            ->addColumn('created_at')
            ->addColumn('created_at_formatted', fn (Product $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
}

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
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
    
            Column::make('Merk', 'merk')    
                ->searchable(),

            Column::make('Harga Jual', 'harga_jual')
                ->hidden()
                ->searchable(),

            Column::make('Harga Jual', 'harga_jual_formatted','harga_jual')    
                ->searchable(),

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

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
            // Filter::inputText('name'),
            // Filter::datepicker('created_at_formatted', 'created_at'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Product Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
       return [
           Button::make('add', '<i class="fas fa-plus"></i>')
               ->class('btn btn-success btn-small')
            ->emit('addToSelected', ['id' => 'id'])
            //    ->route('product.edit', ['product' => 'id']),
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

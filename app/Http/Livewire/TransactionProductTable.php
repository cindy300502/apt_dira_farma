<?php

namespace App\Http\Livewire;

use App\Models\TransactionProduct;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class TransactionProductTable extends PowerGridComponent
{
    use ActionButton;

    // Binding Variable
    public string $filter = '';

    // Listeners
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(), 
            [
                'reloadTable'   => 'reloadTable',
                'setFilter'   => 'setFilter',
            ]);
    }
    public function reloadTable() {
        $this->fillData();
    }
    public function setFilter($id) {
        $this->filter = $id;
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
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\TransactionProduct>
     */
    public function datasource(): Builder
    {
        if (!$this->filter) {
            return TransactionProduct::query();
        }
        return TransactionProduct::with([
            'selling_transaction',
            'product',
            'category',
        ])->whereHas('selling_transaction', function($model) {
            return $model->where('id', '=', $this->filter);
        });
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
        return [];
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
            ->addColumn('product', fn (TransactionProduct $model) => $model->product->nama_produk)
            ->addColumn('category', fn (TransactionProduct $model) => $model->category->nama_kategori)
            ->addColumn('total_item')
            ->addColumn('created_at')
            ->addColumn('price', fn (TransactionProduct $model) => $model->product->harga_jual)
            ->addColumn('price_formatted', fn (TransactionProduct $model) => formatRupiah($model->product->harga_jual))
            ->addColumn('created_at_formatted', fn (TransactionProduct $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i'));
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
            Column::make('Created at', 'created_at')
                ->hidden(),

            Column::make('Waktu', 'created_at_formatted', 'created_at')
                ->sortable()
                ->searchable(),

            Column::make('ID', 'id')
                ->searchable(),

            Column::make('Kategori', 'category'),
            Column::make('Produk', 'product'),
            Column::make('Jumlah item', 'total_item'),
            Column::make('Harga', 'price_formatted', 'price'),
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
     * PowerGrid TransactionProduct Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('transaction-product.edit', ['transaction-product' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('transaction-product.destroy', ['transaction-product' => 'id'])
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid TransactionProduct Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($transaction-product) => $transaction-product->id === 1)
                ->hide(),
        ];
    }
    */
}

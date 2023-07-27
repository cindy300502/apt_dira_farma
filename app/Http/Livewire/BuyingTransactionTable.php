<?php

namespace App\Http\Livewire;

use App\Models\Supplier;
use Illuminate\Support\Carbon;
use App\Models\BuyingTransaction;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class BuyingTransactionTable extends PowerGridComponent
{
    use ActionButton;

    // Listeners
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(), 
            [
                'reloadTable'   => 'reloadTable',
            ]);
    }
    public function reloadTable() {
        $this->fillData();
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
        return BuyingTransaction::with([
            'supplier',
            'product',
            'product_brand',
        ]);
    }

    public function relationSearch(): array
    {
        return [];
    }



    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('supplier', fn (BuyingTransaction $model) => $model->supplier->nama_supplier)
            ->addColumn('product', fn (BuyingTransaction $model) => $model->product->nama_produk)
            ->addColumn('brand', fn (BuyingTransaction $model) => $model->product_brand->nama_merk)
            ->addColumn('total_item')
            ->addColumn('harga')
            ->addColumn('harga_formatted', fn (BuyingTransaction $model) => formatRupiah($model->harga))
            ->addColumn('sub_total', function (BuyingTransaction $model) {
                return (int) $model->total_item * (int) $model->harga;
            })
            ->addColumn('sub_total_formatted', function (BuyingTransaction $model) {
                $sub_total =  (int) $model->total_item * (int) $model->harga;
                return formatRupiah($sub_total);
            })
            ->addColumn('created_at')
            ->addColumn('created_at_formatted', fn (BuyingTransaction $model) => Carbon::parse($model->created_at)->format('d/m/Y'));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->hidden()
                ->searchable()
                ->sortable(),

            Column::make('Created at', 'created_at')
                ->hidden(),

            Column::make('Tanggal Transaksi', 'created_at_formatted', 'created_at')
                ->sortable()
                ->searchable(),

            Column::make('Supplier', 'supplier')
                ->searchable(),

            Column::make('Produk', 'product')
                ->searchable(),

            Column::make('Merk', 'brand')
                ->searchable(),

            Column::make('Total Item', 'total_item')
                ->searchable(),

            Column::make('Harga', 'harga')
                ->hidden()
                ->searchable(),

            Column::make('Harga', 'harga_formatted', 'harga')
                ->searchable(),

            Column::make('Sub Total', 'sub_total')
                ->hidden()
                ->searchable(),

            Column::make('Sub Total', 'sub_total_formatted', 'sub_total')
                ->searchable(),
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
     * PowerGrid BuyingTransaction Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('buying-transaction.edit', ['buying-transaction' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('buying-transaction.destroy', ['buying-transaction' => 'id'])
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
     * PowerGrid BuyingTransaction Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($buying-transaction) => $buying-transaction->id === 1)
                ->hide(),
        ];
    }
    */
}

<?php

namespace App\Http\Livewire;

use App\Models\SellingTransaction;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class SellingReportTable extends PowerGridComponent
{
    use ActionButton;

    // Listeners
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(), 
            [
                'reloadTable'   => 'reloadTable',
                'sendDetailState'   => 'sendDetailState',
            ]);
    }
    public function reloadTable() {
        $this->fillData();
    }
    public function sendDetailState($data) {
        $detail_id = $data['id'];

        $this->emitTo('selling-report-page', 'setDetailState', $detail_id);
        $this->emitTo('transaction-product-table', 'setFilter', $detail_id);
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
        return SellingTransaction::with([
            'user',
            'transaction_product',
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
            ->addColumn('user_name', fn (SellingTransaction $model) => $model->user->name)
            ->addColumn('sub_total')
            ->addColumn('sub_total_formatted', fn (SellingTransaction $model) => formatRupiah($model->sub_total))
            ->addColumn('diskon')
            ->addColumn('diskon_formatted', fn (SellingTransaction $model) => strval($model->diskon) . '%')
            ->addColumn('dibayarkan')
            ->addColumn('dibayarkan_formatted', fn (SellingTransaction $model) => formatRupiah($model->dibayarkan))
            ->addColumn('created_at')
            ->addColumn('created_at_formatted', fn (SellingTransaction $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->hidden(),

            Column::make('Tanggal Transaksi', 'created_at_formatted', 'created_at')
                ->sortable()
                ->searchable(),

            Column::make('Dibayarkan', 'dibayarkan_formatted',' dibayarkan'),
            Column::make('Diskon', 'diskon_formatted',' diskon'),
            Column::make('Sub Total', 'sub_total_formatted',' sub_total'),

            Column::make('User', 'user_name')
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
     * PowerGrid SellingTransaction Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
       return [
           Button::make('detail', 'Detail')
               ->class('btn btn-primary')
               ->emit('sendDetailState', ['id' => 'id'])
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
     * PowerGrid SellingTransaction Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($selling-transaction) => $selling-transaction->id === 1)
                ->hide(),
        ];
    }
    */
}

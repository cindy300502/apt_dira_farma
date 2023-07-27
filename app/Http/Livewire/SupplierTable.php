<?php

namespace App\Http\Livewire;

use App\Models\Supplier;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class SupplierTable extends PowerGridComponent
{
    use ActionButton;

    // Listeners
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(), 
            [
                'deleteSupplier'   => 'deleteSupplier',
                'reloadTable'   => 'reloadTable',
                'sendEditState'   => 'sendEditState',
            ]);
    }
    public function deleteSupplier($data) {
        $Supplier = Supplier::find($data['id']);
        if ($Supplier) {
            $Supplier->delete();
            $this->fillData();
        }
    }
    public function reloadTable() {
        $this->fillData();
    }
    public function sendEditState($data) {
        $supplier_id = $data['id'];
        $this->emitTo('supplier-page', 'editSupplier', $supplier_id);

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
     * @return Builder<\App\Models\Supplier>
     */
    public function datasource(): Builder
    {
        return Supplier::query();
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
            ->addColumn('nama_supplier')
            ->addColumn('alamat')
            ->addColumn('no_telepon')
            ->addColumn('created_at')
            ->addColumn('created_at_formatted', fn (Supplier $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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

            Column::make('Nama', 'nama_supplier')
                ->searchable()
                ->sortable(),

            Column::make('Alamat', 'alamat')
                ->searchable()
                ->sortable(),
            
            Column::make('No Telepon', 'no_telepon')
                ->searchable()
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
            Filter::inputText('name'),
            Filter::datepicker('created_at_formatted', 'created_at'),
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
     * PowerGrid Category Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
       return [
           Button::make('delete', 'Hapus')
                ->class('btn btn-danger')
                ->emit('deleteSupplier', ['id' => 'id']),
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
     * PowerGrid Category Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($category) => $category->id === 1)
                ->hide(),
        ];
    }
    */
}

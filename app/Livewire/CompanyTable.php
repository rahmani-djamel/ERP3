<?php

namespace App\Livewire;

use App\Models\Company;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class CompanyTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Company::query()->with(['package','owner']);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')

           /** Example of custom column using a closure **/
            ->addColumn('name_lower', fn (Company $model) => strtolower(e($model->name)))
            ->addColumn('owner', fn (Company $model) => $model->owner->name)
            ->addColumn('package_id')
            ->addColumn('days')
            ->addColumn('created_at_formatted', fn (Company $model) => Carbon::parse($model->created_at)->isoFormat('LL'))
            ->addColumn('package_name', fn (Company $model) => __($model->package->name));

    }

    public function columns(): array
    {

      //  dd($this->row);
      $canEdit = false; // User has edit permission

        
        return [
            Column::make(__('Id'), 'id'),
            Column::make(__('Name'),'name')

            ->bodyAttribute('rtl:text-end ltr:text-center ')
                ->sortable()
                ->searchable(),

            Column::make(__('Company owner'), 'owner','user.name')
            ->bodyAttribute('rtl:text-end ltr:text-center')
            ,
            Column::make(__('Package'), 'package_name', 'package.name')
            ->bodyAttribute('rtl:text-end ltr:text-center')
            ,
            Column::make(__('Days'), 'days')
            ->bodyAttribute('rtl:text-end ltr:text-center'),


            Column::add()
            ->title(__('Testing period'))
            ->field('Testing_period')
  
            
            ->toggleable($canEdit, __('Testing period'),  __('Subscription'))
            ->bodyAttribute('text-blue-500')
            ->contentClasses([
                'Testing period' => 'text-blue-600',
                'Subscription' => 'text-green-600'
           ]),


            Column::make(__('Created at'), 'created_at_formatted', 'created_at')
                ->sortable(),


                Column::action('actions')

        ];
    }

    public function filters(): array
    {
        return [

        ];
    }


    public function actions(Company $row): array
    {
        return [

            Button::add('edit-package')  
                ->slot('<x-icon name="pencil" class="w-5 h-5" />')
                ->class('bg-indigo-500 text-white p-2 rounded-full')
                ->dispatch('Company-Edited',['id' => $row->id]),

                

            Button::add('delete-package')  
                ->slot('<x-icon name="trash" class="w-5 h-5" />')
                ->class('bg-red-500 text-white p-2 rounded-full')
                ->dispatch('Company-Delete',['id' => $row->id]),

   
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}

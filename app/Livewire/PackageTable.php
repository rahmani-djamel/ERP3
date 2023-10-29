<?php

namespace App\Livewire;

use App\Models\Package;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class PackageTable extends PowerGridComponent
{
    
    public function datasource(): ?Collection
    {
        return settings('packages');
    }

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

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name', function ($entry) {

               // dd($entry->name);
                
                return __($entry->name);
            })
            ->addColumn('price')
            ->addColumn('N_Of_Emps')
            ->addColumn('N_Of_Adminstrative')
            ->addColumn('N_branches')
            ->addColumn('days')

            

            
            ->addColumn('created_at_formatted', function ($entry) {
                return Carbon::parse($entry->created_at)->format('d/m/Y');
            });
    }
    public function actions(Package $row): array
    {
        return [

            Button::add('edit-package')  
            ->slot('<x-icon name="eye" class="w-5 h-5" />')
            ->class('bg-slate-300  text-white p-2 rounded-full'),

            Button::add('edit-package')  
                ->slot('<x-icon name="pencil" class="w-5 h-5" />')
                ->class('bg-indigo-500 text-white p-2 rounded-full'),

            Button::add('edit-package')  
                ->slot('<x-icon name="trash" class="w-5 h-5" />')
                ->class('bg-red-500 text-white p-2 rounded-full'),
   
        ];
    }
    

    public function columns(): array
    {
        return [
            
            Column::make(__('ID'), 'id')
                ->searchable()
                ->bodyAttribute('rtl:text-end ltr:text-center')
                ->sortable(),

            Column::make(__('Name'), 'name',__('name'))
                ->searchable()
                ->bodyAttribute('rtl:text-end ltr:text-center')

                ->sortable(),

            Column::make(__('Days'), 'days')
                ->searchable()
                ->bodyAttribute('rtl:text-end ltr:text-center')

                ->sortable(),

            Column::make(__('Number Of Employees'), 'N_Of_Emps')
                ->searchable()
                ->bodyAttribute('rtl:text-end ltr:text-center')

                ->sortable(),

            Column::make(__('Number of administrators'), 'N_Of_Adminstrative')
                ->searchable()
                ->bodyAttribute('rtl:text-end ltr:text-center')

                ->sortable(),

            Column::make(__('Number of branches'), 'N_branches')
                ->searchable()
                ->bodyAttribute('rtl:text-end ltr:text-center')

                ->sortable(),

            Column::make(__('Price'), 'price')
            ->bodyAttribute('rtl:text-end ltr:text-center')
                ->sortable(),

            Column::make('Created', 'created_at_formatted'),

            Column::action('Actions')
        ];
    }
}

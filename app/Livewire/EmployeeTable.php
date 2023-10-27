<?php

namespace App\Livewire;

use App\Models\Employee;
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

final class EmployeeTable extends PowerGridComponent
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
        return Employee::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('Name')

           /** Example of custom column using a closure **/
            ->addColumn('Name_lower', fn (Employee $model) => strtolower(e($model->Name)))

            ->addColumn('email')
            ->addColumn('CarteNumber')
            ->addColumn('JobNumber')
            ->addColumn('Nationality')
            ->addColumn('Gender')
            ->addColumn('DateOfBirth_formatted', fn (Employee $model) => Carbon::parse($model->DateOfBirth)->format('d/m/Y'))
            ->addColumn('Start_work_formatted', fn (Employee $model) => Carbon::parse($model->Start_work)->format('d/m/Y'))
            ->addColumn('End_formatted', fn (Employee $model) => Carbon::parse($model->End)->format('d/m/Y'))
            ->addColumn('Phone')
            ->addColumn('VacationDays')
            ->addColumn('ContratType')
            ->addColumn('Rating')
            ->addColumn('Status')
            ->addColumn('FriendName')
            ->addColumn('FriendPhone')
            ->addColumn('InsuranceClass')
            ->addColumn('InsuranceExpiryDate_formatted', fn (Employee $model) => Carbon::parse($model->InsuranceExpiryDate)->format('d/m/Y'))
            ->addColumn('BankName')
            ->addColumn('BankNumber')
            ->addColumn('BasicSalary')
            ->addColumn('OtherAllowances')
            ->addColumn('InsuranceRatio')
            ->addColumn('InsuranceSubscriptionAmount')
            ->addColumn('HousingAllowance')
            ->addColumn('transportationAllowance')
            ->addColumn('VacationSalary')
            ->addColumn('DurationOfTheWarningPeriod')
            ->addColumn('LoanHistory')
            ->addColumn('CovenantRecord')
            ->addColumn('user_id')
            ->addColumn('branch_id')
            ->addColumn('is_adminstaror')
            ->addColumn('created_at_formatted', fn (Employee $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Name', 'Name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('CarteNumber', 'CarteNumber')
                ->sortable()
                ->searchable(),

            Column::make('JobNumber', 'JobNumber')
                ->sortable()
                ->searchable(),

            Column::make('Nationality', 'Nationality')
                ->sortable()
                ->searchable(),

            Column::make('Gender', 'Gender')
                ->sortable()
                ->searchable(),

            Column::make('DateOfBirth', 'DateOfBirth_formatted', 'DateOfBirth')
                ->sortable(),

            Column::make('Start work', 'Start_work_formatted', 'Start_work')
                ->sortable(),

            Column::make('End', 'End_formatted', 'End')
                ->sortable(),

            Column::make('Phone', 'Phone')
                ->sortable()
                ->searchable(),

            Column::make('VacationDays', 'VacationDays'),
            Column::make('ContratType', 'ContratType')
                ->sortable()
                ->searchable(),

            Column::make('Rating', 'Rating')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'Status')
                ->sortable()
                ->searchable(),

            Column::make('FriendName', 'FriendName')
                ->sortable()
                ->searchable(),

            Column::make('FriendPhone', 'FriendPhone')
                ->sortable()
                ->searchable(),

            Column::make('InsuranceClass', 'InsuranceClass')
                ->sortable()
                ->searchable(),

            Column::make('InsuranceExpiryDate', 'InsuranceExpiryDate_formatted', 'InsuranceExpiryDate')
                ->sortable(),

            Column::make('BankName', 'BankName')
                ->sortable()
                ->searchable(),

            Column::make('BankNumber', 'BankNumber')
                ->sortable()
                ->searchable(),

            Column::make('BasicSalary', 'BasicSalary')
                ->sortable()
                ->searchable(),

            Column::make('OtherAllowances', 'OtherAllowances')
                ->sortable()
                ->searchable(),

            Column::make('InsuranceRatio', 'InsuranceRatio')
                ->sortable()
                ->searchable(),

            Column::make('InsuranceSubscriptionAmount', 'InsuranceSubscriptionAmount')
                ->sortable()
                ->searchable(),

            Column::make('HousingAllowance', 'HousingAllowance')
                ->sortable()
                ->searchable(),

            Column::make('TransportationAllowance', 'transportationAllowance')
                ->sortable()
                ->searchable(),

            Column::make('VacationSalary', 'VacationSalary')
                ->sortable()
                ->searchable(),

            Column::make('DurationOfTheWarningPeriod', 'DurationOfTheWarningPeriod')
                ->sortable()
                ->searchable(),

            Column::make('LoanHistory', 'LoanHistory')
                ->sortable()
                ->searchable(),

            Column::make('CovenantRecord', 'CovenantRecord')
                ->sortable()
                ->searchable(),

            Column::make('User id', 'user_id'),
            Column::make('Branch id', 'branch_id'),
            Column::make('Is adminstaror', 'is_adminstaror'),
            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('Name')->operators(['contains']),
            Filter::inputText('email')->operators(['contains']),
            Filter::inputText('CarteNumber')->operators(['contains']),
            Filter::inputText('JobNumber')->operators(['contains']),
            Filter::inputText('Nationality')->operators(['contains']),
            Filter::inputText('Gender')->operators(['contains']),
            Filter::datepicker('DateOfBirth'),
            Filter::datepicker('Start_work'),
            Filter::datepicker('End'),
            Filter::inputText('Phone')->operators(['contains']),
            Filter::inputText('ContratType')->operators(['contains']),
            Filter::inputText('Rating')->operators(['contains']),
            Filter::inputText('Status')->operators(['contains']),
            Filter::inputText('FriendName')->operators(['contains']),
            Filter::inputText('FriendPhone')->operators(['contains']),
            Filter::inputText('InsuranceClass')->operators(['contains']),
            Filter::datepicker('InsuranceExpiryDate'),
            Filter::inputText('BankName')->operators(['contains']),
            Filter::inputText('BankNumber')->operators(['contains']),
            Filter::inputText('BasicSalary')->operators(['contains']),
            Filter::inputText('OtherAllowances')->operators(['contains']),
            Filter::inputText('InsuranceRatio')->operators(['contains']),
            Filter::inputText('InsuranceSubscriptionAmount')->operators(['contains']),
            Filter::inputText('HousingAllowance')->operators(['contains']),
            Filter::inputText('transportationAllowance')->operators(['contains']),
            Filter::inputText('VacationSalary')->operators(['contains']),
            Filter::inputText('DurationOfTheWarningPeriod')->operators(['contains']),
            Filter::inputText('LoanHistory')->operators(['contains']),
            Filter::inputText('CovenantRecord')->operators(['contains']),
            Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(\App\Models\Employee $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id])
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

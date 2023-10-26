<?php

namespace App\Livewire\Backend\Company\Vacation;

use App\Models\Employee;
use App\Models\Worktime;
use App\Traits\Vacation\VacationTrait;
use Livewire\Component;
use WireUi\Traits\Actions;

class WorktimeEdit extends Component
{
    use Actions,VacationTrait;


    public Employee $employee;
    public $days= [];
    public $keysToDisplay = [];
    public $selected;

    public $start = "00:00";
    public $end = "00:00";
    public $is_vacation = false;

    public function rules()
    {
        return [
            'start' => 'required',
            'end' => 'required'

        ];
    }


    public function mount()
    {
        $this->days = $this->employee->worktime;
        $this->keysToDisplay = $this->body();
    }

    public function save()
    {
        $this->validate();
        $this->selected = Worktime::findorfail($this->selected['id']);
        $this->selected->work_start = $this->start;
        $this->selected->work_end = $this->end;
        $this->selected->is_vacation = $this->is_vacation;
        $this->selected->is_changed = 1;
        $this->selected->save();

        $this->dialog()->success(
            $title = __('Time edited'),
            $description = __('Successfully edited')
        );

        $this->dispatch('refresh');

    }

    public function selection($item)  {
        $this->selected = $item;

        //dd($this->selected);
        
    }


    public function render()
    {
        return view('livewire.backend.company.vacation.worktime-edit');
    }
}

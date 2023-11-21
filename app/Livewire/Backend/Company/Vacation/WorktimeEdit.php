<?php

namespace App\Livewire\Backend\Company\Vacation;

use App\Models\Employee;
use App\Models\Worktime;
use App\Traits\Vacation\VacationTrait;
use Carbon\Carbon;
use Livewire\Component;
use WireUi\Traits\Actions;

class WorktimeEdit extends Component
{
    use Actions,VacationTrait;


    public Employee $employee;
    public $days= [];
    public $keysToDisplay = [];
    public $selected;

    public $start = [];
    public $end = [];
    public $is_vacation = false;

    public function rules()
    {
        return [
            'start.hour' => 'required|numeric|min:0|max:12',
            'start.minute' => 'required|numeric|min:0|max:59',
            'end.hour' => 'required|numeric|min:0|max:12',
            'end.minute' => 'required|numeric|min:0|max:59',
        ];
    }
    


    public function mount()
    {
        $this->days = $this->employee->worktime;
        $this->keysToDisplay = $this->body();

       // dd($this->days,$this->keysToDisplay);
    }

    public function save()
    {
        
        $this->validate();




        $startDateTime = Carbon::createFromTime($this->start['hour'], $this->start['minute']);
        $endDateTime = Carbon::createFromTime($this->end['hour'], $this->end['minute']);

        if ($startDateTime->greaterThanOrEqualTo($endDateTime)) {

            $this->dialog()->error(
                $title = __('error'),
                $description = __('Something is wrong')
            );

            return;
        }

        
       

        $this->selected = Worktime::findorfail($this->selected['id']);
        $this->selected->work_start = $startDateTime;
        $this->selected->work_end = $endDateTime;
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

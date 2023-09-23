<?php

namespace App\Livewire\Backend\Company\Vacation;

use App\Models\Vacation;
use App\Traits\Vacation\VacationTrait;
use Livewire\Component;
use WireUi\Traits\Actions;

class Weekend extends Component
{
    use VacationTrait,Actions;

    public  $headers = [];
    public $keysToDisplay = [];
    public $days= [];
    
    public $start;
    public $end;
    public $is_vacation = false;
    public $selected;

    public function rules()
    {
        return [
            'start' => 'required',
            'end' => 'required'

        ];
    }


    public function mount()
    {
        $this->headers = $this->header(); 
        $this->keysToDisplay = $this->body();

        $this->days = Vacation::all();
    }
    public function selection($id)  {
        $this->selected =  $id;
    }
    public function save()
    {
        $this->validate();
        $this->selected = Vacation::findorfail($this->selected['id']);
        $this->selected->work_start = $this->start;
        $this->selected->work_end = $this->end;
        $this->selected->is_vacation = $this->is_vacation;
        $this->selected->save();

        $this->dialog()->success(
            $title = 'تعديل التوقيت',
            $description = 'تم التعديل بنجاح'
        );

        $this->dispatch('refresh');

    }

    public function render()
    {
        return view('livewire.backend.company.vacation.weekend');
    }
}

<?php

namespace App\Livewire\Backend\Employee\Resumption;

use App\Models\AnnualHoliday;
use App\Models\ResumeWork;
use Carbon\Carbon;
use Livewire\Component;
use WireUi\Traits\Actions;

class Index extends Component
{
    use Actions;

    public $employee;
    public $checker = false;
    public $vacationToday;
    public $resume = false;

    public function mount()
    {

        $today = Carbon::today();
        $this->employee = auth()->user()->employee;

        //dd($this->employee);

        $this->vacationToday = AnnualHoliday::where('employee_id', $this->employee->id)
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->first();

        if ($this->vacationToday) 
        {

            $resume = ResumeWork::where('employee_id',$this->employee->id)
            ->where('annualholiday_id',$this->vacationToday->id)
            ->first();
            if ($resume) 
            {
                $this->resume = true;
            }
            $this->checker = true;
        }

    }

    public function save()
    {
        if ($this->checker) 
        {
            if (!$this->resume) 
            {
                $resume = new ResumeWork();
                $resume->employee_id = $this->employee->id;
                $resume->annualholiday_id = $this->vacationToday->id;
    
                $resume->save();
    
                $this->dialog([
                    'title'       => __('sucess'),
                    'description' => __('Work has resumed'),
                    'icon'        => 'success',
                    'close'      => [
                        'label'  => __('Ok')
                    ],
                ]);
                
                $this->dispatch('refresh');

            } else {
                
                $this->dialog([
                    'title'       => __('error'),
                    'description' => __('It has been appealed before'),
                    'icon'        => 'error',
                    'close'      => [
                        'label'  => __('Ok')
                    ],
                ]);

            }
            

        
            

        } else
        {
            $this->dialog([
                'title'       => __('error'),
                'description' => __('you are not on vacation'),
                'icon'        => 'error',
                'close'      => [
                    'label'  => __('Ok')
                ],
            ]);
            
        }
        

    }
    
    public function render()
    {
        return view('livewire.backend.employee.resumption.index')->layout('layouts.employee');
    }
}

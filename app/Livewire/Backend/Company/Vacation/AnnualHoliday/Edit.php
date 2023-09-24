<?php

namespace App\Livewire\Backend\Company\Vacation\AnnualHoliday;

use App\Models\AnnualHoliday;
use App\Models\Employee;
use Carbon\Carbon;
use Livewire\Component;
use WireUi\Traits\Actions;

class Edit extends Component
{
    use Actions;

    public $search =  '';
    public $selected = '';
    public $start;
    public $end;
    public $extendDays = 0;

    public function mount()
    {
      //  $this->holidays = AnnualHoliday::with('employee')->get();

    }
    public function updating($property,$value)
    {

    }
    public function saveTime()
    {
        if ($this->start != null && $this->end != null) {
            $this->start = Carbon::parse($this->start);
            $this->end = Carbon::parse($this->end);

           if ($this->end->gt($this->start)) {
            // 

         
               $holiday = AnnualHoliday::findorfail($this->selected['id']);
               $holiday->start_date = $this->start;
               $holiday->end_date = $this->end;

               $holiday->save();

               $this->dialog()->success(
                $title = 'تعديل الإجازة',
                $description = 'تم تعديل الإجازة بنجاح'
            );

            $this->dispatch('refresh');



               //  dd($this->afterReduce);
           }else{
            $this->dialog()->error(
                $title = ' خطأ',
                $description = 'وقت البداية اكبر من وقت النهاية'
            );
           }
        }

    }
    public function saveDelete()
    {
        $holiday = AnnualHoliday::findorfail($this->selected['id']);


        $holiday->delete();

        $this->dialog()->success(
         $title = 'حذف الإجازة',
         $description = 'تم حذف الإجازة بنجاح'
     );
     $this->dispatch('refresh');


    }
    public function saveExtend()
    {
        if ($this->extendDays > 0) {

            $holiday = AnnualHoliday::findorfail($this->selected['id']);
            $holiday->extend = 1;
            $holiday->extend_days = $this->extendDays;

            $holiday->save();

            $this->dialog()->success(
             $title = 'تعديل الإجازة',
             $description = 'تم تعديل الإجازة بنجاح'
         );

         $this->dispatch('refresh');

            
        }
        else{

            $this->dialog()->error(
                $title = ' خطأ',
                $description = 'وقت البداية اكبر من وقت النهاية'
            );

        }
    }
    public function selection($item)
    {
        $this->selected = $item;
        $this->start = $item['start_date'];
        $this->end = $item['end_date'];


      //  dd($this->start,$this->end);


    }
    public function render()
    {
        return view('livewire.backend.company.vacation.annual-holiday.edit',
        [
            'holidays' => AnnualHoliday::with('employee')->search($this->search)->get()
        ]
    );
    }
}

<?php

namespace App\Livewire\Backend\Company\Attendance;

use App\Models\Attendance;
use App\Models\Employee;
use App\Traits\Attendance\AttendanceTrait;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use WireUi\Traits\Actions;

class Report extends Component
{
    use AttendanceTrait,Actions;
    public $search = '';
    public $start;
    public $end;
    public $employees;
    public $Start_work;
    public $branche;
    public $selected;
    public $status;
    public $empid;
    public $idAtt;
    public $selectedDay;
    public $Newstatus;
    public $empName = '';

    
    public function mount()
    {

        Carbon::setLocale('ar');

        $this->employees = $this->ReportByWeek();
        $this->start = Carbon::parse($this->employees['startWeek'])->isoFormat('dddd, Y-M-D');
        $this->end = Carbon::parse($this->employees['endWeek'])->isoFormat('dddd, Y-M-D');

        $this->employees = $this->employees['formattedEmployees'];

       // dd($this->employees);


       // dd($this->employees);
    }
    public function updating($proprety,$value)
    {
        if ($proprety == 'Start_work')
        {
            if($this->branche != null){
                $this->employees = $this->ReportByWeek($this->Start_work,$this->branche);
            }else{
                $this->employees = $this->ReportByWeek($this->Start_work);
            }

            $this->start = Carbon::parse($this->employees['startWeek'])->isoFormat('dddd, Y-M-D');
            $this->end = Carbon::parse($this->employees['endWeek'])->isoFormat('dddd, Y-M-D');
            $this->employees = $this->employees['formattedEmployees'];
        }

        if ($proprety == 'branche')
        {
            if($this->Start_work != null){
                $this->employees = $this->ReportByWeek($this->Start_work,$value);
            }else{
                $this->employees = $this->ReportByWeek(today(),$value);
            }

            $this->start = Carbon::parse($this->employees['startWeek'])->isoFormat('dddd, Y-M-D');
            $this->end = Carbon::parse($this->employees['endWeek'])->isoFormat('dddd, Y-M-D');
            $this->employees = $this->employees['formattedEmployees'];
        }

    }
    #[On('post-created')] 
    public function updatePostList($selectedoption,$id,$current)
    {
        $attendance = Attendance::findorfail($id);
        $attendance->status = $selectedoption;
        $attendance->save();

        $this->dialog()->success(
            $title = 'تم التعديل',
            $description = 'تم التعديل بنجاح'
        );

    }     
    public function selection($status,$id,$idEmployee,$name,$cle)
    {
        dd($status,$id,$idEmployee,$name,$this->start,$this->end,$cle);
        $this->status= $status;
        $this->empid = $idEmployee;
        $this->idAtt = $id;
        $this->empName = $name;
        $this->selectedDay = $cle;
    }
    public function save()
    {
        
        $attendance = Attendance::findorfail($this->idAtt);
        $attendance->status = $this->Newstatus;
        $attendance->save();

        $this->dialog()->success(
            $title = 'تم التعديل',
            $description = 'تم التعديل بنجاح'
        );
        $this->dispatch('refresh');
    }


    // Rest of your Livewire component code

    public function resetTable()
    {

        $this->employees = $this->ReportByWeek();
        $this->start = Carbon::parse($this->employees['startWeek'])->isoFormat('dddd, Y-M-D');
        $this->end = Carbon::parse($this->employees['endWeek'])->isoFormat('dddd, Y-M-D');

        $this->employees = $this->employees['formattedEmployees'];

    }
    public function render()
    {
        return view('livewire.backend.company.attendance.report');
    }
}

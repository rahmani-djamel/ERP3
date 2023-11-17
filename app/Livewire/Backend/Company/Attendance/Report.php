<?php

namespace App\Livewire\Backend\Company\Attendance;

use App\Models\Attendance;
use App\Models\Branche;
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
    public $branches;

    
    public function mount()
    {

        $this->employees = $this->ReportByWeek();
        $this->start = Carbon::parse($this->employees['startWeek'])->isoFormat('dddd, Y-M-D');
        $this->end = Carbon::parse($this->employees['endWeek'])->isoFormat('dddd, Y-M-D');

        $this->employees = $this->employees['formattedEmployees'];

        $this->branches = Branche::where('company_id',$this->company()->id)->get();


       // dd($this->employees);


       // dd($this->employees);
    }

    
    public function company()
    {
        $user = auth()->user();

        if ($user->hasRole('manger')) {
           return $user->company;
        } else {
            return $user->employee->company;
        }
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
    public function updatePostList($selectedoption, $id, $current,$day)
    {
        $attendance = Attendance::firstOrNew(['id' => $id]);
    
        // Check if the record exists
        if ($attendance->exists) {
            // If the record exists, update its status
            $attendance->status = $selectedoption;
            $attendance->save();
        } else {
                    // Parse the strings to create Carbon objects
        $start_date = Carbon::parse(substr($this->start, strpos($this->start, ',') + 2));
        $end_date = Carbon::parse(substr($this->end, strpos($this->end, ',') + 2));

        // Now $start_date and $end_date are Carbon objects
     
   
                $Cday = Carbon::parse($day);

                $current_date = $start_date;
                $dates_on_day = null;

                while ($current_date->lte($end_date)) {
                    if ($current_date->dayOfWeek == $Cday->dayOfWeek) {
                        $dates_on_day = $current_date->toDateString();
                        break; // Break the loop once the first Monday is found
                    }
                    $current_date->addDay();
                }
              //  $attendance->attendance_date = $dates_on_day;


    

            dd($selectedoption, $id,$Cday->translatedFormat('l'), $current,$this->start,$this->end,$dates_on_day);
            // If the record doesn't exist, create a new one with five fields
  
        }
    
        $this->dialog()->success(
            $title = __('Edited successfully'),
            $description = __('Successfully edited')
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

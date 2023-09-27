<?php

namespace App\Livewire\Backend\Company\Settings;

use App\Models\Setting;
use Livewire\Component;
use WireUi\Traits\Actions;

class Main extends Component
{
    use Actions;
    public $setting;
    public $DaysMonth;
    public $MinVacationDays;
    public $ValidityOfAnnualLeave;
    public $Guarantee;
    public $WillPay;
    public $MaximumVacationEmployees;
    public $AutomaticDeduction;
    public $PeriodBetweenTwoVacations;
    public $SubmittingLeave;
    public $AutomaticApproval;
    public $date;
    public $nationalities;
    public $VacationDay;

    public function mount()
    {
        $this->setting = Setting::first();
        $this->DaysMonth = $this->setting->DaysMonth;
        $this->MinVacationDays = $this->setting->MinVacationDays;
        $this->ValidityOfAnnualLeave = $this->setting->ValidityOfAnnualLeave;
        $this->Guarantee = $this->setting->Guarantee;
        $this->WillPay = $this->setting->WillPay;
        $this->MaximumVacationEmployees = $this->setting->MaximumVacationEmployees;
        $this->AutomaticDeduction = $this->setting->AutomaticDeduction;
        $this->PeriodBetweenTwoVacations = $this->setting->PeriodBetweenTwoVacations;
        $this->SubmittingLeave = $this->setting->SubmittingLeave;
        $this->AutomaticApproval = $this->setting->AutomaticApproval;

        $this->date = $this->setting->PathCreated;
        $this->nationalities = json_decode($this->setting->Nationality, true);
        $this->VacationDay	 = json_decode($this->setting->VacationDay, true);

    }
    public function save()
    {
        $this->setting->update([
            'DaysMonth' => $this->DaysMonth,
            'MinVacationDays' => $this->MinVacationDays,
            'ValidityOfAnnualLeave' => $this->ValidityOfAnnualLeave,
            'Guarantee' => $this->Guarantee,
            'WillPay' => $this->WillPay,
            'MaximumVacationEmployees' => $this->MaximumVacationEmployees,
            'AutomaticDeduction' => $this->AutomaticDeduction,
            'PeriodBetweenTwoVacations' => $this->PeriodBetweenTwoVacations,
            'SubmittingLeave' => $this->SubmittingLeave,
            'AutomaticApproval' => $this->AutomaticApproval,
            'PathCreated' => $this->date,
            'Nationality' => json_encode($this->nationalities),
            'VacationDay' => json_encode($this->VacationDay),
        ]);
        

        $this->dialog()->success(
            $title = 'تم التعديل',
            $description = 'تم التعديل بنجاح'
        );
    }
    public function render()
    {
        return view('livewire.backend.company.settings.main');
    }
}

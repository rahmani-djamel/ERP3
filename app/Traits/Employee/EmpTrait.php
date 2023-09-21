<?php

namespace App\Traits\Employee;

use App\Models\Employee;
use App\Models\File;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

trait EmpTrait
{
    public function createUser($validated)
    {
        $user = new User();
        $user->name = $validated['Name'];
        $user->email = $validated['email'];
        $user->password = Hash::make('123456789');
        $user->save();

        return $user;
        
    }

    public function createEmp($validated,$user)
    {
       $employee =  new Employee([
            'Name' => $validated['Name'],
            'email' => $validated['email'],
            'CarteNumber' => $validated['CarteNumber'],
            'JobNumber' => $validated['JobNumber'],
            'Nationality' => $validated['Nationality'],
            'Gender' => $validated['Gender'],
            'DateOfBirth' => $validated['DateOfBirth'],
            'Start_work' => $validated['Start_work'],
            'End' => $validated['End'],
            'Phone' => $validated['Phone'],
            'VacationDays' => $validated['VacationDays'],
            'ContratType' => $validated['ContratType'],
            'Rating' => $validated['Rating'],
            'Status' => $validated['Status'],
            'FriendName' => $validated['FriendName'],
            'FriendPhone' => $validated['FriendPhone'],
            'InsuranceClass' => $validated['InsuranceClass'],
            'InsuranceExpiryDate' => $validated['InsuranceExpiryDate'],
            'BankName' => $validated['BankName'],
            'BankNumber' => $validated['BankNumber'],
            'BasicSalary' => $validated['BasicSalary'],
            'OtherAllowances' => $validated['OtherAllowances'],
            'InsuranceRatio' => $validated['InsuranceRatio'],
            'InsuranceSubscriptionAmount' => $validated['InsuranceSubscriptionAmount'],
            'HousingAllowance' => $validated['HousingAllowance'],
            'transportationAllowance' => $validated['transportationAllowance'],
            'VacationSalary' => $validated['VacationSalary'],
            'DurationOfTheWarningPeriod' => $validated['DurationOfTheWarningPeriod'],
            'LoanHistory' => $validated['LoanHistory'],
            'CovenantRecord' => $validated['CovenantRecord'],
            'user_id' => $user->id,
        ]);
        
        // Save the employee to the database
        $employee->save();

        return $employee;

    }
/*
    public function storeFiles($files,$user,$employee)
    {

        if (!empty($files)) {
        
            
            foreach ($files as $file) {
                // Process each file here, e.g., store it or do some other operation
                $mimeType = $file->getMimeType();
               
        
                $type_files = ['image','pdf'];
                if (str_contains($mimeType, $type_files[0])) {
                    $type_files = "image";
                }else{
                    $type_files = "pdf";
                }
        
        
        
               // dd($mimeType);
        
                $newImage = new File();
                $fileName = $file->getClientOriginalName();
                $filePath = 'employees/' . $user->id ;
            
                // Upload the image to DigitalOcean Spaces
                $path = Storage::disk('local')->putFileAs($filePath, $file, $fileName, 'public');
            
                // Set the path of the image in the database
                $newImage->path = $path;
                $newImage->type =  $type_files;
                $employee->files()->save($newImage);
        
        }
        }

        return true;

    }*/

    public function header()
    {
      return  $columnMapping = [
            'Name' => 'الاسم',
            'JobNumber' => 'الرقم الوظيفي',
            'Gender' => 'الجنس',
            'Nationality' => 'الجنسية',
            'DateOfBirth' => 'تاريخ الميلاد',
            'Start_work' => 'تاريخ المباشرة',
            'ContratType' => 'نوع العقد',
            'CarteNumber' => 'رقم البطاقة',
            'VacationSalary' => 'راتب الإجازة',
            'VacationDays' => 'رصيد الإجازة',
            'Status' => 'حالة الموظف',
            'Rating' => 'التقييم',
            'BasicSalary' => 'الراتب الأساسي',
            'HousingAllowance' => 'بدل السكن',
            'transportationAllowance' => 'بدل المواصلات',
            'Name1' => 'الاسم', //1
            'Name2' => 'الاسم', //2
            'InsuranceRatio' => 'نسبة التأمينات',
            'InsuranceSubscriptionAmount' => 'مبلغ اشتراك التأمينات',
            'Phone' => 'الهاتف',
            'email' => 'البريد الإلكتروني',
            'FriendName' => 'صديق في حالة الطوارئ',
            'CovenantRecord' => 'سجل العهد',
            'InsuranceClass' => 'فئة التأمينات',
            'End' => 'تاريخ الانتهاء',
            'Name3' => 'الاسم', //2
        ];
        
    }
    public function body()
    {
        $columnMap = [
            'Name' => 'Name',
            'JobNumber' => 'Job Number',
            'Gender' => 'Gender',
            'Nationality' => 'Nationality',
            'DateOfBirth' => 'Date of Birth',
            'Start_work' => 'Start Work Date',
            'ContratType' => 'Contract Type',
            'CarteNumber' => 'Carte Number',
            'VacationSalary' => 'Vacation Salary',
            'VacationDays' => 'Vacation Days',
            'Status' => 'Status',
            'Rating' => 'Rating',
            'BasicSalary' => 'Basic Salary',
            'HousingAllowance' => 'Housing Allowance',
            'transportationAllowance' => 'Transportation Allowance',
            'Name1' => 'Name', //1
            'Name2' => 'Name', //2

            'InsuranceRatio' => 'Insurance Ratio',
            'InsuranceSubscriptionAmount' => 'Insurance Subscription Amount',
            'Phone' => 'Phone',
            'email' => 'Email',
            'FriendName' => 'Friend Name',
            'CovenantRecord' => 'Covenant Record',
            'InsuranceClass' => 'Insurance Class',
            'End' => 'End Date',
            'Name3' => 'Name', //3

        ];
    
        $columnKeys = array_keys($columnMap);

        return $columnKeys;

    }
}
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

}
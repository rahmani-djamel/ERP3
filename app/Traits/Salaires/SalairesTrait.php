<?php

namespace App\Traits\Salaires;

trait SalairesTrait
{

    public function header()
    {
       return $columnMapping = [
            'التسلسل' => 'id',
            'الرقم الوظيفي' => 'Job number',
            'الإسم' => 'name',
            'الراتب الأساسي' => 'Basic salary',
            'بدل السكن' => 'Housing allowance',
            'بدل المواصلات' => 'Transportation allowance',
            'الوقت الإضافي' => 'Extra time',
            'الحوافز' => 'Incentives',
            'العمولات' => 'Commissions',
            'المجموع الإجمالي' => 'Total',
            'الغيابات' => 'Absences',
            'تأخير' => 'Delay',
            'قروض او سلف' => 'Loans or advances',
            'مجموع الحسوم' => 'Total discounts',
            'صافي الراتب' => 'Net salary',
            'الحالة' => 'Status'
        ];
        
        
    }


}
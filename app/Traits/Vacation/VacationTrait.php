<?php

namespace App\Traits\Vacation;

trait VacationTrait
{

    public function header()
    {
      return  $columnMapping = [
            'weekday' => ' الأسبوع',
            'work_start' => 'وقت البداية',
            'work_end' => 'وقت النهاية',
        ];
        
    }
    public function body()
    {
       return $columnMap = [
            'weekday',
            'work_start',
            'work_end',

        ];
    }



}
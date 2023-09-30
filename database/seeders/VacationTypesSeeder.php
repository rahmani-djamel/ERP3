<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VacationTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vacationTypes = [
            'أجازة عادية للسعوديين',
            'الإجازة العادية - غياب بعذر',
            'إجازة الوفاة',
            'أجازة إضطرارية للسعوديين',
            'الإجازة المرضية',
            'إجازة مرافقة مريض',
            'الإجازة الإستثنائية',
            'إجازة إستثنائية للمرافقة',
            'إجازة الامتحان الدراسي',
            'إجازة الأبوة',
            'إجازة تعويض تأخير',
            'إجازة وقوع كارثة',
            'إجازة ثقافية داخلية',
            'إجازة ثقافية خارجية',
            'المشاركة في أعمال الإغاثة',
            'إجازة غسيل فشل كلوي',
            'إجازة رياضية داخلية',
            'إجازة رياضية خارجية',
            'إجازة مرضية بسبب مرض خطير',
        ];
    
        foreach ($vacationTypes as $type) {
            DB::table('vacationtypes')->insert(['name' => $type]);
        }
    }
}

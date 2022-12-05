<?php

namespace App\Exports;

use App\Models\Branch;
use App\Models\Supervisor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SupervisorsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $supervisors = Supervisor::select('name', 'email', 'phone_number', 'role_name', 'branch_id', 'created_at')->get();
        $supervisors->transform(function ($i) {
            if(!empty($i->branch_id)){
                $i->branch_id = Branch::FindOrFail($i->branch_id)->branch_name;
            }
            else{
                $i->branch_id = "كل الفروع";
            }
            return $i;
        });
        return $supervisors;
    }

    public function headings(): array
    {
        return [
            'الاسم',
            'البريد الالكترونى',
            'رقم الجوال',
            'الصلاحية',
            'الفرع',
            'تاريخ الاضافة'
        ];
    }

}

<?php

namespace App\Exports;
use App\Models\Branch;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BranchesExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        return Branch::select('branch_name','branch_phone','branch_address','commercial_record',
            'license_number','snap','created_at')->get();
    }
    public function headings(): array
    {
        return [
            'اسم الفرع',
            'رقم الجوال',
            'عنوان الفرع',
            'سجل تجارى',
            'رقم ترخيص',
            'snap',
            'تاريخ الاضافة'
        ];
    }
}

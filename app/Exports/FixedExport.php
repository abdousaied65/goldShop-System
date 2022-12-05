<?php

namespace App\Exports;
use App\Models\FixedExpense;
use App\Models\Supervisor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FixedExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        $fixed =  FixedExpense::select('supervisor_id', 'fixed_expense','created_at')->get();
        $fixed->transform(function($i){
            $i->supervisor_id = Supervisor::FindOrFail($i->supervisor_id)->name;
            return $i;
        });

        return $fixed;
    }
    public function headings(): array
    {
        return [
            'المسؤول',
            'المصروف الثابت',
            'تاريخ الاضافة'
        ];
    }
}

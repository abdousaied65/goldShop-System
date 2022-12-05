<?php

namespace App\Exports;

use App\Models\Branch;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        if (empty(Auth::user()->branch_id)) {
            $Employees = Employee::select('name', 'branch_id', 'created_at')->get();
        } else {
            $branch = Branch::FindOrFail(Auth::user()->branch_id);
            $Employees = Employee::select('name', 'branch_id', 'created_at')
                ->where('branch_id',$branch->id)
                ->get();
        }

        $Employees->transform(function ($i) {
            $i->branch_id = Branch::FindOrFail($i->branch_id)->branch_name;
            return $i;
        });
        return $Employees;
    }

    public function headings(): array
    {
        return [
            'الاسم',
            'الفرع',
            'تاريخ الاضافة'
        ];
    }

}

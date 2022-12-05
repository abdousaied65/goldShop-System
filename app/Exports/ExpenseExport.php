<?php

namespace App\Exports;

use App\Models\Branch;
use App\Models\Expense;
use App\Models\FixedExpense;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExpenseExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        if (empty(Auth::user()->branch_id)) {
            $expense = Expense::select('branch_id', 'supervisor_id', 'fixed_id', 'unified_serial_number', 'date', 'expense_details',
                'amount', 'notes', 'created_at')->get();
        } else {
            $branch = Branch::FindOrFail(Auth::user()->branch_id);
            $expense = Expense::select('branch_id', 'supervisor_id', 'fixed_id', 'unified_serial_number', 'date', 'expense_details',
                'amount', 'notes', 'created_at')
                ->where('branch_id', $branch->id)
                ->get();
        }

        $expense->transform(function ($i) {
            if (!empty($i->branch_id)) {
                $i->branch_id = Branch::FindOrFail($i->branch_id)->branch_name;
            } else {
                $i->branch_id = "كل الفروع";
            }
            $i->supervisor_id = Supervisor::FindOrFail($i->supervisor_id)->name;
            $i->fixed_id = FixedExpense::FindOrFail($i->fixed_id)->fixed_expense;
            return $i;
        });

        return $expense;
    }

    public function headings(): array
    {
        return [
            'الفرع',
            'المسؤول',
            'المصروف الثابت',
            'رقم التسلسلي للمصروف',
            'التاريخ',
            'تفاصيل المصروف',
            'المبلغ',
            'ملاحظات',
            'تاريخ الاضافة'
        ];
    }
}

<?php

namespace App\Exports;
use App\Models\Branch;
use App\Models\PurchaseInvoice;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PurchaseExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        if (empty(Auth::user()->branch_id)) {
            $purchase =  PurchaseInvoice::select('invoice_number','date','branch_id','employee_id',
                'tax_total','final_total','created_at')->get();
        } else {
            $branch = Branch::FindOrFail(Auth::user()->branch_id);
            $purchase =  PurchaseInvoice::select('invoice_number','date','branch_id','employee_id',
                'tax_total','final_total','created_at')
                ->where('branch_id',$branch->id)
                ->get();
        }
        $purchase->transform(function($i){
            if(!empty($i->branch_id)){
                $i->branch_id = Branch::FindOrFail($i->branch_id)->branch_name;
            }
            else{
                $i->branch_id = "كل الفروع";
            }
            $i->employee_id = Employee::FindOrFail($i->employee_id)->name;
            return $i;
        });

        return $purchase;
    }
    public function headings(): array
    {
        return [
            'رقم الفاتورة',
            'التاريخ',
            'الفرع',
            'الموظف',
            'اجمالى الضريبة',
            'المبلغ النهائى',
            'تاريخ الاضافة'
        ];
    }
}

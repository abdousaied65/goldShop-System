<?php

namespace App\Exports;
use App\Models\Branch;
use App\Models\TaxInvoice;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TaxExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        if (empty(Auth::user()->branch_id)) {
            $tax =  TaxInvoice::select('unified_serial_number','company_name','company_tax_number','date','time','payment_method','branch_id'
                ,'employee_id','total_count','total_weight','gram_total_price','amount_total',
                'tax_total','final_total','created_at')->where('status','done')->get();
        } else {
            $branch = Branch::FindOrFail(Auth::user()->branch_id);
            $tax =  TaxInvoice::select('unified_serial_number','company_name','company_tax_number','date','time','payment_method','branch_id'
                ,'employee_id','total_count','total_weight','gram_total_price','amount_total',
                'tax_total','final_total','created_at')
                ->where('status','done')
                ->where('branch_id',$branch->id)
                ->get();
        }
        $tax->transform(function($i){
            if(!empty($i->branch_id)){
                $i->branch_id = Branch::FindOrFail($i->branch_id)->branch_name;
            }
            else{
                $i->branch_id = "كل الفروع";
            }
            $i->employee_id = Employee::FindOrFail($i->employee_id)->name;
            return $i;
        });

        return $tax;
    }
    public function headings(): array
    {
        return [
            'رقم الفاتورة',
            'اسم الشركة',
            'الرقم الضريبى للشركة',
            'التاريخ',
            'الوقت',
            'طريقة الدفع',
            'الفرع',
            'الموظف',
            'اجمالى العدد',
            'اجمالى الوزن',
            'اجمالى سعر الجرام',
            'اجمالى المبلغ',
            'اجمالى الضريبة',
            'المبلغ النهائى',
            'تاريخ الاضافة'
        ];
    }
}

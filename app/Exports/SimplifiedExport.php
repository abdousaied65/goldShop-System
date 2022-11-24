<?php

namespace App\Exports;
use App\Models\Branch;
use App\Models\SimplifiedInvoice;
use App\Models\Supervisor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SimplifiedExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        $simplified =  SimplifiedInvoice::select('unified_serial_number','date','time','payment_method','branch_id'
            ,'supervisor_id','total_count','total_weight','gram_total_price','amount_total',
            'tax_total','final_total','created_at')->where('status','done')->get();
        $simplified->transform(function($i){
            if(!empty($i->branch_id)){
                $i->branch_id = Branch::FindOrFail($i->branch_id)->branch_name;
            }
            else{
                $i->branch_id = "كل الفروع";
            }
            $i->supervisor_id = Supervisor::FindOrFail($i->supervisor_id)->name;
            return $i;
        });

        return $simplified;
    }
    public function headings(): array
    {
        return [
            'رقم الفاتورة',
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

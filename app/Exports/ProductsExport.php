<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $products = Product::select('product_name', 'tax', 'created_at')->get();

        $products->transform(function($i) {
            $i->tax = $i->tax." % ";
            return $i;
        });

        return $products;
    }

    public function headings(): array
    {
        return [
            'اسم المنتج',
            'ضريبة القيمة المضافة',
            'تاريخ الاضافة'
        ];
    }
}

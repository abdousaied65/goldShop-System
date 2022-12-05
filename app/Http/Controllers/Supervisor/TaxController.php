<?php

namespace App\Http\Controllers\Supervisor;

use App\Exports\TaxExport;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\Product;
use App\Models\TaxInvoice;
use App\Models\TaxInvoiceElement;
use App\Models\TaxPayment;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index(Request $request)
    {
        if (empty(Auth::user()->branch_id)) {
            $data = TaxInvoice::where('status', 'done')->get();
        } else {
            $data = TaxInvoice::where('branch_id', Auth::user()->branch_id)->where('status', 'done')->get();
        }
        $branches = Branch::all();
        return view('supervisor.tax.index', compact('data', 'branches'));
    }

    public function search(Request $request)
    {
        $branch_id = $request->branch_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $data = TaxInvoice::where('branch_id', $branch_id)->where('status', 'done')
            ->whereBetween('date', [$from_date, $to_date])
            ->get();
        $branches = Branch::all();
        return view('supervisor.tax.index', compact('data', 'branch_id', 'from_date', 'to_date', 'branches'));
    }

    public function create()
    {
        $products = Product::all();
        $check = TaxInvoice::all();
        if ($check->isEmpty()) {
            $unified_serial_number = 1;
        } else {
            $old_pre_counter = TaxInvoice::max('unified_serial_number');
            $unified_serial_number = $old_pre_counter + 1;
        }
        $auth_id = Auth::user()->id;
        $step = TaxInvoice::where('supervisor_id', $auth_id)
            ->where('status', 'open')
            ->first();
        if (!empty($step)) {
            $open_invoice = $step;
        } else {
            $open_invoice = "";
        }
        $branches = Branch::all();
        $employees = Employee::all();

        return view('supervisor.tax.create', compact('products', 'branches', 'employees', 'open_invoice', 'unified_serial_number'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $supervisor_id = Auth::user()->id;
        $product_id = $request->product_id;
        $open_invoice = TaxInvoice::where('supervisor_id', $supervisor_id)
            ->where('status', 'open')
            ->first();
        if (empty($open_invoice)) {
            $open_invoice = TaxInvoice::create($data);
        } else {
            $open_invoice->update($data);
        }
        $data['tax_id'] = $open_invoice->id;
        $element = TaxInvoiceElement::where('product_id', $product_id)
            ->where('tax_id', $open_invoice->id)
            ->first();
        $data['product_id'] = $product_id;

        $product = Product::FindOrFail($product_id);

        $product_tax = $product->tax;

        $tax_v1 = 1 + $product_tax / 100;
        $tax_v2 = $product_tax / 100;

        $data['amount'] = round($request->total / $tax_v1, 2);
        $data['tax'] = round($data['amount'] * $tax_v2, 2);


        $data['gram_price'] = round($data['amount'] / $request->weight, 2);
        $tax_element = TaxInvoiceElement::create($data);


        $elements = $open_invoice->elements;
        if ($elements->isEmpty()) {
            $data['total_count'] = $data['count'];
            $data['total_weight'] = $data['weight'];
            $data['gram_total_price'] = $data['gram_price'];
            $data['amount_total'] = $data['amount'];
            $data['tax_total'] = $data['tax'];
            $data['final_total'] = $data['total'];
        } else {
            $total_count = 0;
            $total_weight = 0;
            $amount_total = 0;
            $tax_total = 0;
            $final_total = 0;
            foreach ($elements as $element) {
                $total_count = $total_count + $element->count;
                $total_weight = $total_weight + $element->weight;
                $amount_total = $amount_total + $element->amount;
                $tax_total = $tax_total + $element->tax;
                $final_total = $final_total + $element->total;
                $gram_total_price = $amount_total / $total_weight;
            }
            $data['total_count'] = round($total_count, 2);
            $data['total_weight'] = round($total_weight, 2);
            $data['gram_total_price'] = round($gram_total_price, 2);
            $data['amount_total'] = round($amount_total, 2);
            $data['tax_total'] = round($tax_total, 2);
            $data['final_total'] = round($final_total, 2);
        }

        $open_invoice->update($data);

        return redirect()->route('supervisor.tax.create')
            ->with('success', 'تمت الاضافة بنجاح');
    }

    public function delete_element(Request $request)
    {
        $element_id = $request->element_id;
        $element = TaxInvoiceElement::FindOrFail($element_id);
        $tax_invoice = $element->TaxInvoice;

        $total_count = $tax_invoice->total_count;
        $total_weight = $tax_invoice->total_weight;
        $amount_total = $tax_invoice->amount_total;
        $tax_total = $tax_invoice->tax_total;
        $final_total = $tax_invoice->final_total;

        $total_count = $total_count - $element->count;
        $total_weight = $total_weight - $element->weight;
        $amount_total = $amount_total - $element->amount;
        $tax_total = $tax_total - $element->tax;
        $final_total = $final_total - $element->total;
        if ($total_weight == 0) {
            $gram_total_price = 0;
        } else {
            $gram_total_price = $amount_total / $total_weight;
        }

        $tax_invoice->update([
            'total_count' => $total_count,
            'total_weight' => $total_weight,
            'amount_total' => $amount_total,
            'tax_total' => $tax_total,
            'final_total' => $final_total,
            'gram_total_price' => $gram_total_price
        ]);
        $element->delete();
    }

    public function delete_tax(Request $request)
    {
        $tax_id = $request->tax_id;
        $tax = TaxInvoice::FindOrFail($tax_id);
        $tax->delete();
    }

    public function save_tax(Request $request)
    {
        $tax_id = $request->tax_id;
        $tax = TaxInvoice::FindOrFail($tax_id);
        if ($tax->payment_method == "cash" || $tax->payment_method == "visa") {
            $payment = TaxPayment::create([
                'tax_id' => $tax->id,
                'amount' => $tax->final_total,
                'payment_method' => $tax->payment_method,
            ]);
            if ($tax->payment_method == "cash") {
                $tax->update([
                    'status' => 'done',
                    'cash_amount' => $tax->final_total,
                    'visa_amount' => null,
                ]);
            } elseif ($tax->payment_method == "visa") {
                $tax->update([
                    'status' => 'done',
                    'visa_amount' => $tax->final_total,
                    'cash_amount' => null,
                ]);
            }
        } else {
            $cash_amount = $request->cash_amount;
            $visa_amount = $request->visa_amount;
            $payment = TaxPayment::create([
                'tax_id' => $tax->id,
                'amount' => $cash_amount,
                'payment_method' => "cash",
            ]);
            $payment = TaxPayment::create([
                'tax_id' => $tax->id,
                'amount' => $visa_amount,
                'payment_method' => "visa",
            ]);
            $tax->update([
                'status' => 'done',
                'cash_amount' => $cash_amount,
                'visa_amount' => $visa_amount,
            ]);
        }
    }

    public function export_tax_excel()
    {
        return Excel::download(new TaxExport(), 'كل الفواتير الضريبية للشركات والمؤسسات.xlsx');
    }

    public function print($id)
    {
        $tax = TaxInvoice::FindOrFail($id);
        if (!empty($tax)) {
            $elements = $tax->elements;
            if ($elements->isEmpty()) {
                return abort('404');
            } else {
                return view('supervisor.tax.print', compact('tax'));
            }
        } else {
            return abort('404');
        }
    }

    public function edit($id)
    {
        $open_invoice = TaxInvoice::findOrFail($id);
        $unified_serial_number = $open_invoice->unified_serial_number;
        $products = Product::all();
        $branches = Branch::all();
        $employees = Employee::all();
        return view('supervisor.tax.edit',
            compact('products', 'branches', 'employees', 'open_invoice', 'unified_serial_number'));
    }

    public function update_tax(Request $request)
    {
        $tax_id = $request->tax_id;
        $payment_method = $request->payment_method;
        $date = $request->date;
        $time = $request->time;
        $company_name = $request->company_name;
        $company_tax_number = $request->company_tax_number;
        $branch_id = $request->branch_id;
        $employee_id = $request->employee_id;
        $tax = TaxInvoice::FindOrFail($tax_id);
        $payments = $tax->payments;
        foreach ($payments as $payment) {
            $payment->delete();
        }
        if ($payment_method == "cash" || $payment_method == "visa") {
            $payment = TaxPayment::create([
                'tax_id' => $tax->id,
                'amount' => $tax->final_total,
                'payment_method' => $payment_method,
            ]);
            if ($payment_method == "cash") {
                $tax->update([
                    'status' => 'done',
                    'company_name' => $company_name,
                    'company_tax_number' => $company_tax_number,
                    'date' => $date,
                    'time' => $time,
                    'branch_id' => $branch_id,
                    'employee_id' => $employee_id,
                    'cash_amount' => $tax->final_total,
                    'visa_amount' => null,
                    'payment_method' => 'cash'
                ]);
            } elseif ($payment_method == "visa") {
                $tax->update([
                    'status' => 'done',
                    'date' => $date,
                    'company_name' => $company_name,
                    'company_tax_number' => $company_tax_number,
                    'time' => $time,
                    'branch_id' => $branch_id,
                    'employee_id' => $employee_id,
                    'visa_amount' => $tax->final_total,
                    'cash_amount' => null,
                    'payment_method' => 'visa'
                ]);
            }
        } else {
            $cash_amount = $request->cash_amount;
            $visa_amount = $request->visa_amount;
            $payment = TaxPayment::create([
                'tax_id' => $tax->id,
                'amount' => $cash_amount,
                'payment_method' => "cash",
            ]);
            $payment = TaxPayment::create([
                'tax_id' => $tax->id,
                'amount' => $visa_amount,
                'payment_method' => "visa",
            ]);
            $tax->update([
                'status' => 'done',
                'date' => $date,
                'company_name' => $company_name,
                'company_tax_number' => $company_tax_number,
                'time' => $time,
                'branch_id' => $branch_id,
                'employee_id' => $employee_id,
                'cash_amount' => $cash_amount,
                'visa_amount' => $visa_amount,
                'payment_method' => 'mixed'
            ]);
        }
    }

    public function redirector($id)
    {

        return redirect()->route('supervisor.tax.index')
            ->with('success', 'تم تعديل الفاتورة بنجاح');
    }

}

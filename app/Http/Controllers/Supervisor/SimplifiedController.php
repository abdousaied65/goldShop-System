<?php

namespace App\Http\Controllers\Supervisor;

use App\Exports\SimplifiedExport;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\Product;
use App\Models\SimplifiedInvoice;
use App\Models\SimplifiedInvoiceElement;
use App\Models\SimplifiedPayment;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class SimplifiedController extends Controller
{
    public function index(Request $request)
    {
        if (empty(Auth::user()->branch_id)) {
            $data = SimplifiedInvoice::where('status', 'done')->get();
        } else {
            $data = SimplifiedInvoice::where('branch_id', Auth::user()->branch_id)->where('status', 'done')->get();
        }
        $branches = Branch::all();
        return view('supervisor.simplified.index', compact('data', 'branches'));
    }

    public function search(Request $request)
    {
        $branch_id = $request->branch_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $data = SimplifiedInvoice::where('branch_id', $branch_id)->where('status', 'done')
            ->whereBetween('date', [$from_date, $to_date])
            ->get();
        $branches = Branch::all();
        return view('supervisor.simplified.index', compact('data', 'branch_id', 'from_date', 'to_date', 'branches'));
    }

    public function create()
    {
        $products = Product::all();
        $check = SimplifiedInvoice::all();
        if ($check->isEmpty()) {
            $unified_serial_number = 1;
        } else {
            $old_pre_counter = SimplifiedInvoice::max('unified_serial_number');
            $unified_serial_number = $old_pre_counter + 1;
        }
        $auth_id = Auth::user()->id;
        $step = SimplifiedInvoice::where('supervisor_id', $auth_id)
            ->where('status', 'open')
            ->first();
        if (!empty($step)) {
            $open_invoice = $step;
        } else {
            $open_invoice = "";
        }
        $branches = Branch::all();
        $employees = Employee::all();
        return view('supervisor.simplified.create',
            compact('products', 'branches', 'employees', 'open_invoice', 'unified_serial_number'));
    }

    public function edit($id)
    {
        $open_invoice = SimplifiedInvoice::findOrFail($id);
        $unified_serial_number = $open_invoice->unified_serial_number;
        $products = Product::all();
        $branches = Branch::all();
        $employees = Employee::all();
        return view('supervisor.simplified.edit',
            compact('products', 'branches', 'employees', 'open_invoice', 'unified_serial_number'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $supervisor_id = Auth::user()->id;
        $product_id = $request->product_id;
        $open_invoice = SimplifiedInvoice::where('supervisor_id', $supervisor_id)
            ->where('status', 'open')
            ->first();
        if (empty($open_invoice)) {
            $open_invoice = SimplifiedInvoice::create($data);
        } else {
            $open_invoice->update($data);
        }
        $data['simplified_id'] = $open_invoice->id;
        $element = SimplifiedInvoiceElement::where('product_id', $product_id)
            ->where('simplified_id', $open_invoice->id)
            ->first();

        $data['product_id'] = $product_id;

        $product = Product::FindOrFail($product_id);

        $product_tax = $product->tax;

        $tax_v1 = 1 + ($product_tax / 100);
        $tax_v2 = $product_tax / 100;

        $data['amount'] = round($request->total / $tax_v1, 2);
        $data['tax'] = round($data['amount'] * $tax_v2, 2);


        $data['gram_price'] = round($data['amount'] / $request->weight, 2);
        $simplified_element = SimplifiedInvoiceElement::create($data);


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

        return redirect()->route('supervisor.simplified.create')
            ->with('success', 'تمت الاضافة بنجاح');
    }

    public function delete_element(Request $request)
    {
        $element_id = $request->element_id;
        $element = SimplifiedInvoiceElement::FindOrFail($element_id);
        $simplified_invoice = $element->simplified;

        $total_count = $simplified_invoice->total_count;
        $total_weight = $simplified_invoice->total_weight;
        $amount_total = $simplified_invoice->amount_total;
        $tax_total = $simplified_invoice->tax_total;
        $final_total = $simplified_invoice->final_total;

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

        $simplified_invoice->update([
            'total_count' => $total_count,
            'total_weight' => $total_weight,
            'amount_total' => $amount_total,
            'tax_total' => $tax_total,
            'final_total' => $final_total,
            'gram_total_price' => $gram_total_price
        ]);
        $element->delete();
    }

    public function delete_simplified(Request $request)
    {
        $simplified_id = $request->simplified_id;
        $simplified = SimplifiedInvoice::FindOrFail($simplified_id);
        $simplified->delete();
    }

    public function save_simplified(Request $request)
    {
        $simplified_id = $request->simplified_id;
        $simplified = SimplifiedInvoice::FindOrFail($simplified_id);
        if ($simplified->payment_method == "cash" || $simplified->payment_method == "visa") {
            $payment = SimplifiedPayment::create([
                'simplified_id' => $simplified->id,
                'amount' => $simplified->final_total,
                'payment_method' => $simplified->payment_method,
            ]);
            if ($simplified->payment_method == "cash") {
                $simplified->update([
                    'status' => 'done',
                    'cash_amount' => $simplified->final_total,
                    'visa_amount' => null,
                ]);
            } elseif ($simplified->payment_method == "visa") {
                $simplified->update([
                    'status' => 'done',
                    'visa_amount' => $simplified->final_total,
                    'cash_amount' => null,
                ]);
            }
        } else {
            $cash_amount = $request->cash_amount;
            $visa_amount = $request->visa_amount;
            $payment = SimplifiedPayment::create([
                'simplified_id' => $simplified->id,
                'amount' => $cash_amount,
                'payment_method' => "cash",
            ]);
            $payment = SimplifiedPayment::create([
                'simplified_id' => $simplified->id,
                'amount' => $visa_amount,
                'payment_method' => "visa",
            ]);
            $simplified->update([
                'status' => 'done',
                'cash_amount' => $cash_amount,
                'visa_amount' => $visa_amount,
            ]);
        }
    }


    public function export_simplified_excel()
    {
        return Excel::download(new SimplifiedExport(), 'كل الفواتير الضريبية المبسطة.xlsx');
    }

    public function print($id)
    {
        $simplified = SimplifiedInvoice::FindOrFail($id);
        if (!empty($simplified)) {
            $elements = $simplified->elements;
            if ($elements->isEmpty()) {
                return abort('404');
            } else {
                return view('supervisor.simplified.print', compact('simplified'));
            }
        } else {
            return abort('404');
        }
    }

    public function get_branch_employees(Request $request)
    {
        $branch_id = $request->branch_id;
        if ($branch_id == "all"){
            $branch_employees = Employee::all();
        }
        else{
            $branch = Branch::FindOrFail($branch_id);
            $branch_employees = $branch->employees;
        }
        echo '<option value=""></option>';
        foreach ($branch_employees as $employee) {
            echo "<option value='" . $employee->id . "'>" . $employee->name . "</option>";
        }
    }

    public function update_simplified(Request $request)
    {
        $simplified_id = $request->simplified_id;
        $payment_method = $request->payment_method;
        $date = $request->date;
        $time = $request->time;
        $branch_id = $request->branch_id;
        $employee_id = $request->employee_id;
        $simplified = SimplifiedInvoice::FindOrFail($simplified_id);
        $payments = $simplified->payments;
        foreach ($payments as $payment) {
            $payment->delete();
        }
        if ($payment_method == "cash" || $payment_method == "visa") {
            $payment = SimplifiedPayment::create([
                'simplified_id' => $simplified->id,
                'amount' => $simplified->final_total,
                'payment_method' => $payment_method,
            ]);
            if ($payment_method == "cash") {
                $simplified->update([
                    'status' => 'done',

                    'date' => $date,
                    'time' => $time,
                    'branch_id' => $branch_id,
                    'employee_id' => $employee_id,

                    'cash_amount' => $simplified->final_total,
                    'visa_amount' => null,
                    'payment_method' => 'cash'
                ]);
            } elseif ($payment_method == "visa") {
                $simplified->update([
                    'status' => 'done',
                    'date' => $date,
                    'time' => $time,
                    'branch_id' => $branch_id,
                    'employee_id' => $employee_id,
                    'visa_amount' => $simplified->final_total,
                    'cash_amount' => null,
                    'payment_method' => 'visa'
                ]);
            }
        } else {
            $cash_amount = $request->cash_amount;
            $visa_amount = $request->visa_amount;
            $payment = SimplifiedPayment::create([
                'simplified_id' => $simplified->id,
                'amount' => $cash_amount,
                'payment_method' => "cash",
            ]);
            $payment = SimplifiedPayment::create([
                'simplified_id' => $simplified->id,
                'amount' => $visa_amount,
                'payment_method' => "visa",
            ]);
            $simplified->update([
                'status' => 'done',
                'date' => $date,
                'time' => $time,
                'branch_id' => $branch_id,
                'employee_id' => $employee_id,
                'cash_amount' => $cash_amount,
                'visa_amount' => $visa_amount,
                'payment_method' => 'mixed'
            ]);
        }
    }

    public function redirector()
    {
        return redirect()->route('supervisor.simplified.index')
            ->with('success', 'تم تعديل الفاتورة بنجاح');
    }

}

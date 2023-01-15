<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\FixedExpense;
use App\Models\Product;
use App\Models\PurchaseInvoice;
use App\Models\SimplifiedInvoice;
use App\Models\SimplifiedInvoiceElement;
use App\Models\TaxInvoice;
use App\Models\TaxInvoiceElement;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reports()
    {
        return view('supervisor.reports.reports');
    }

    public function simplified_report1_get()
    {
        $branches = Branch::all();
        return view('supervisor.reports.simplified.report1.view', compact('branches'));
    }

    public function simplified_report1_post(Request $request)
    {
        $branches = Branch::all();
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->get();
            }
        }
        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;
        foreach ($invoices as $invoice) {
            $sum_amount_total = round(($sum_amount_total + $invoice->amount_total), 2);
            $sum_total_weight = round(($sum_total_weight + $invoice->total_weight), 2);
            $sum_final_total = round(($sum_final_total + $invoice->final_total), 2);
            $sum_tax_total = round(($sum_tax_total + $invoice->tax_total), 2);
        }
        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplified.report1.view', compact('branches', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function simplified_report1_print(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->get();
            }
        }
        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;
        foreach ($invoices as $invoice) {
            $sum_amount_total = round(($sum_amount_total + $invoice->amount_total), 2);
            $sum_total_weight = round(($sum_total_weight + $invoice->total_weight), 2);
            $sum_final_total = round(($sum_final_total + $invoice->final_total), 2);
            $sum_tax_total = round(($sum_tax_total + $invoice->tax_total), 2);
        }
        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplified.report1.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));

    }

    public function simplified_report2_get()
    {
        $branches = Branch::all();
        return view('supervisor.reports.simplified.report2.view', compact('branches'));
    }

    public function simplified_report2_post(Request $request)
    {
        $branches = Branch::all();
        $karat = $request->karat;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('karat', $karat)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplified.report2.view', compact('branches', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function simplified_report2_print(Request $request)
    {
        $karat = $request->karat;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('karat', $karat)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplified.report2.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));

    }

    public function simplified_report3_get()
    {
        $branches = Branch::all();
        $employees = Employee::all();
        return view('supervisor.reports.simplified.report3.view', compact('branches', 'employees'));
    }

    public function simplified_report3_post(Request $request)
    {
        $branches = Branch::all();
        $employees = Employee::all();
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $employee_id = $request->employee_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('employee_id', $employee_id)
                    ->where('status', 'done')
                    ->get();
            }
        }
        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;
        foreach ($invoices as $invoice) {
            $sum_amount_total = round(($sum_amount_total + $invoice->amount_total), 2);
            $sum_total_weight = round(($sum_total_weight + $invoice->total_weight), 2);
            $sum_final_total = round(($sum_final_total + $invoice->final_total), 2);
            $sum_tax_total = round(($sum_tax_total + $invoice->tax_total), 2);
        }
        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplified.report3.view', compact('employees', 'branches', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function simplified_report3_print(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $employee_id = $request->employee_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('employee_id', $employee_id)
                    ->where('status', 'done')
                    ->get();
            }
        }
        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;
        foreach ($invoices as $invoice) {
            $sum_amount_total = round(($sum_amount_total + $invoice->amount_total), 2);
            $sum_total_weight = round(($sum_total_weight + $invoice->total_weight), 2);
            $sum_final_total = round(($sum_final_total + $invoice->final_total), 2);
            $sum_tax_total = round(($sum_tax_total + $invoice->tax_total), 2);
        }
        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplified.report3.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }


    public function simplified_report4_get()
    {
        $branches = Branch::all();
        $employees = Employee::all();
        return view('supervisor.reports.simplified.report4.view', compact('employees', 'branches'));
    }

    public function simplified_report4_post(Request $request)
    {
        $branches = Branch::all();
        $employees = Employee::all();
        $employee_id = $request->employee_id;
        $karat = $request->karat;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('karat', $karat)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplified.report4.view', compact('branches', 'employees', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function simplified_report4_print(Request $request)
    {
        $employee_id = $request->employee_id;
        $karat = $request->karat;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('karat', $karat)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplified.report4.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }


    public function simplified_report5_get()
    {
        $branches = Branch::all();
        $products = Product::all();
        return view('supervisor.reports.simplified.report5.view', compact('products', 'branches'));
    }

    public function simplified_report5_post(Request $request)
    {
        $branches = Branch::all();
        $products = Product::all();
        $product_id = $request->product_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('product_id', $product_id)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplified.report5.view', compact('branches', 'products', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function simplified_report5_print(Request $request)
    {
        $product_id = $request->product_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('product_id', $product_id)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplified.report5.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function simplified_report6_get()
    {
        $branches = Branch::all();
        $employees = Employee::all();
        $products = Product::all();
        return view('supervisor.reports.simplified.report6.view', compact('employees', 'products', 'branches'));
    }

    public function simplified_report6_post(Request $request)
    {
        $branches = Branch::all();
        $employees = Employee::all();
        $products = Product::all();
        $employee_id = $request->employee_id;
        $product_id = $request->product_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('product_id', $product_id)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplified.report6.view', compact('branches', 'products', 'employees', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function simplified_report6_print(Request $request)
    {
        $employee_id = $request->employee_id;
        $product_id = $request->product_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('product_id', $product_id)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplified.report6.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }


    public function simplified_report7_get()
    {
        $branches = Branch::all();
        return view('supervisor.reports.simplified.report7.view', compact('branches'));
    }

    public function simplified_report7_post(Request $request)
    {
        $branches = Branch::all();
        $min_gram_price = $request->min_gram_price;
        $max_gram_price = $request->max_gram_price;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->whereBetween('gram_price', [$min_gram_price, $max_gram_price])
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplified.report7.view', compact('branches', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function simplified_report7_print(Request $request)
    {
        $min_gram_price = $request->min_gram_price;
        $max_gram_price = $request->max_gram_price;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->whereBetween('gram_price', [$min_gram_price, $max_gram_price])
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplified.report7.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }


    public function simplified_report8_get()
    {
        $branches = Branch::all();
        $employees = Employee::all();
        return view('supervisor.reports.simplified.report8.view', compact('employees', 'branches'));
    }

    public function simplified_report8_post(Request $request)
    {
        $branches = Branch::all();
        $employees = Employee::all();
        $min_gram_price = $request->min_gram_price;
        $max_gram_price = $request->max_gram_price;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $employee_id = $request->employee_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->whereBetween('gram_price', [$min_gram_price, $max_gram_price])
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplified.report8.view', compact('branches', 'employees', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function simplified_report8_print(Request $request)
    {

        $min_gram_price = $request->min_gram_price;
        $max_gram_price = $request->max_gram_price;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $employee_id = $request->employee_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->whereBetween('gram_price', [$min_gram_price, $max_gram_price])
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplified.report8.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));

    }

    public function tax_report1_get()
    {
        $branches = Branch::all();
        return view('supervisor.reports.tax.report1.view', compact('branches'));
    }

    public function tax_report1_post(Request $request)
    {
        $branches = Branch::all();
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
            } else {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
            } else {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->get();
            }
        }
        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;
        foreach ($invoices as $invoice) {
            $sum_amount_total = round(($sum_amount_total + $invoice->amount_total), 2);
            $sum_total_weight = round(($sum_total_weight + $invoice->total_weight), 2);
            $sum_final_total = round(($sum_final_total + $invoice->final_total), 2);
            $sum_tax_total = round(($sum_tax_total + $invoice->tax_total), 2);
        }
        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.tax.report1.view', compact('branches', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function tax_report1_print(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
            } else {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
            } else {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'done')
                    ->get();
            }
        }
        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;
        foreach ($invoices as $invoice) {
            $sum_amount_total = round(($sum_amount_total + $invoice->amount_total), 2);
            $sum_total_weight = round(($sum_total_weight + $invoice->total_weight), 2);
            $sum_final_total = round(($sum_final_total + $invoice->final_total), 2);
            $sum_tax_total = round(($sum_tax_total + $invoice->tax_total), 2);
        }
        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.tax.report1.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));

    }


    public function simplifiedreturn_report1_get()
    {
        $branches = Branch::all();
        return view('supervisor.reports.simplifiedreturn.report1.view', compact('branches'));
    }

    public function simplifiedreturn_report1_post(Request $request)
    {
        $branches = Branch::all();
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        }
        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;
        foreach ($invoices as $invoice) {
            $sum_amount_total = round(($sum_amount_total + $invoice->amount_total), 2);
            $sum_total_weight = round(($sum_total_weight + $invoice->total_weight), 2);
            $sum_final_total = round(($sum_final_total + $invoice->final_total), 2);
            $sum_tax_total = round(($sum_tax_total + $invoice->tax_total), 2);
        }
        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplifiedreturn.report1.view', compact('branches', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function simplifiedreturn_report1_print(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        }
        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;
        foreach ($invoices as $invoice) {
            $sum_amount_total = round(($sum_amount_total + $invoice->amount_total), 2);
            $sum_total_weight = round(($sum_total_weight + $invoice->total_weight), 2);
            $sum_final_total = round(($sum_final_total + $invoice->final_total), 2);
            $sum_tax_total = round(($sum_tax_total + $invoice->tax_total), 2);
        }
        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplifiedreturn.report1.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));

    }

    public function simplifiedreturn_report2_get()
    {
        $branches = Branch::all();
        return view('supervisor.reports.simplifiedreturn.report2.view', compact('branches'));
    }

    public function simplifiedreturn_report2_post(Request $request)
    {
        $branches = Branch::all();
        $karat = $request->karat;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('karat', $karat)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplifiedreturn.report2.view', compact('branches', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function simplifiedreturn_report2_print(Request $request)
    {
        $karat = $request->karat;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('karat', $karat)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplifiedreturn.report2.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));

    }

    public function simplifiedreturn_report3_get()
    {
        $branches = Branch::all();
        $employees = Employee::all();
        return view('supervisor.reports.simplifiedreturn.report3.view', compact('branches', 'employees'));
    }

    public function simplifiedreturn_report3_post(Request $request)
    {
        $branches = Branch::all();
        $employees = Employee::all();
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $employee_id = $request->employee_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('employee_id', $employee_id)
                    ->where('status', 'return')
                    ->get();
            }
        }
        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;
        foreach ($invoices as $invoice) {
            $sum_amount_total = round(($sum_amount_total + $invoice->amount_total), 2);
            $sum_total_weight = round(($sum_total_weight + $invoice->total_weight), 2);
            $sum_final_total = round(($sum_final_total + $invoice->final_total), 2);
            $sum_tax_total = round(($sum_tax_total + $invoice->tax_total), 2);
        }
        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplifiedreturn.report3.view', compact('employees', 'branches', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function simplifiedreturn_report3_print(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $employee_id = $request->employee_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('employee_id', $employee_id)
                    ->where('status', 'return')
                    ->get();
            }
        }
        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;
        foreach ($invoices as $invoice) {
            $sum_amount_total = round(($sum_amount_total + $invoice->amount_total), 2);
            $sum_total_weight = round(($sum_total_weight + $invoice->total_weight), 2);
            $sum_final_total = round(($sum_final_total + $invoice->final_total), 2);
            $sum_tax_total = round(($sum_tax_total + $invoice->tax_total), 2);
        }
        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplifiedreturn.report3.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }


    public function simplifiedreturn_report4_get()
    {
        $branches = Branch::all();
        $employees = Employee::all();
        return view('supervisor.reports.simplifiedreturn.report4.view', compact('employees', 'branches'));
    }

    public function simplifiedreturn_report4_post(Request $request)
    {
        $branches = Branch::all();
        $employees = Employee::all();
        $employee_id = $request->employee_id;
        $karat = $request->karat;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('karat', $karat)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplifiedreturn.report4.view', compact('branches', 'employees', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function simplifiedreturn_report4_print(Request $request)
    {
        $employee_id = $request->employee_id;
        $karat = $request->karat;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('karat', $karat)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplifiedreturn.report4.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }


    public function simplifiedreturn_report5_get()
    {
        $branches = Branch::all();
        $products = Product::all();
        return view('supervisor.reports.simplifiedreturn.report5.view', compact('products', 'branches'));
    }

    public function simplifiedreturn_report5_post(Request $request)
    {
        $branches = Branch::all();
        $products = Product::all();
        $product_id = $request->product_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('product_id', $product_id)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplifiedreturn.report5.view', compact('branches', 'products', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function simplifiedreturn_report5_print(Request $request)
    {
        $product_id = $request->product_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('product_id', $product_id)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplifiedreturn.report5.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function simplifiedreturn_report6_get()
    {
        $branches = Branch::all();
        $employees = Employee::all();
        $products = Product::all();
        return view('supervisor.reports.simplifiedreturn.report6.view', compact('employees', 'products', 'branches'));
    }

    public function simplifiedreturn_report6_post(Request $request)
    {
        $branches = Branch::all();
        $employees = Employee::all();
        $products = Product::all();
        $employee_id = $request->employee_id;
        $product_id = $request->product_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('product_id', $product_id)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplifiedreturn.report6.view', compact('branches', 'products', 'employees', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function simplifiedreturn_report6_print(Request $request)
    {
        $employee_id = $request->employee_id;
        $product_id = $request->product_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('product_id', $product_id)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplifiedreturn.report6.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }


    public function simplifiedreturn_report7_get()
    {
        $branches = Branch::all();
        return view('supervisor.reports.simplifiedreturn.report7.view', compact('branches'));
    }

    public function simplifiedreturn_report7_post(Request $request)
    {
        $branches = Branch::all();
        $min_gram_price = $request->min_gram_price;
        $max_gram_price = $request->max_gram_price;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->whereBetween('gram_price', [$min_gram_price, $max_gram_price])
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplifiedreturn.report7.view', compact('branches', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function simplifiedreturn_report7_print(Request $request)
    {
        $min_gram_price = $request->min_gram_price;
        $max_gram_price = $request->max_gram_price;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->whereBetween('gram_price', [$min_gram_price, $max_gram_price])
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplifiedreturn.report7.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }


    public function simplifiedreturn_report8_get()
    {
        $branches = Branch::all();
        $employees = Employee::all();
        return view('supervisor.reports.simplifiedreturn.report8.view', compact('employees', 'branches'));
    }

    public function simplifiedreturn_report8_post(Request $request)
    {
        $branches = Branch::all();
        $employees = Employee::all();
        $min_gram_price = $request->min_gram_price;
        $max_gram_price = $request->max_gram_price;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $employee_id = $request->employee_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->whereBetween('gram_price', [$min_gram_price, $max_gram_price])
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplifiedreturn.report8.view', compact('branches', 'employees', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function simplifiedreturn_report8_print(Request $request)
    {

        $min_gram_price = $request->min_gram_price;
        $max_gram_price = $request->max_gram_price;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $employee_id = $request->employee_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->whereBetween('gram_price', [$min_gram_price, $max_gram_price])
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.simplifiedreturn.report8.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));

    }


    public function taxreturn_report1_get()
    {
        $branches = Branch::all();
        return view('supervisor.reports.taxreturn.report1.view', compact('branches'));
    }

    public function taxreturn_report1_post(Request $request)
    {
        $branches = Branch::all();
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        }
        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;
        foreach ($invoices as $invoice) {
            $sum_amount_total = round(($sum_amount_total + $invoice->amount_total), 2);
            $sum_total_weight = round(($sum_total_weight + $invoice->total_weight), 2);
            $sum_final_total = round(($sum_final_total + $invoice->final_total), 2);
            $sum_tax_total = round(($sum_tax_total + $invoice->tax_total), 2);
        }
        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.taxreturn.report1.view', compact('branches', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function taxreturn_report1_print(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        }
        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;
        foreach ($invoices as $invoice) {
            $sum_amount_total = round(($sum_amount_total + $invoice->amount_total), 2);
            $sum_total_weight = round(($sum_total_weight + $invoice->total_weight), 2);
            $sum_final_total = round(($sum_final_total + $invoice->final_total), 2);
            $sum_tax_total = round(($sum_tax_total + $invoice->tax_total), 2);
        }
        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.taxreturn.report1.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));

    }

    public function taxreturn_report2_get()
    {
        $branches = Branch::all();
        return view('supervisor.reports.taxreturn.report2.view', compact('branches'));
    }

    public function taxreturn_report2_post(Request $request)
    {
        $branches = Branch::all();
        $karat = $request->karat;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = TaxInvoiceElement::where('tax_id', $invoice->id)
                ->where('karat', $karat)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.taxreturn.report2.view', compact('branches', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function taxreturn_report2_print(Request $request)
    {
        $karat = $request->karat;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = TaxInvoiceElement::where('tax_id', $invoice->id)
                ->where('karat', $karat)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.taxreturn.report2.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));

    }

    public function taxreturn_report3_get()
    {
        $branches = Branch::all();
        $employees = Employee::all();
        return view('supervisor.reports.taxreturn.report3.view', compact('branches', 'employees'));
    }

    public function taxreturn_report3_post(Request $request)
    {
        $branches = Branch::all();
        $employees = Employee::all();
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $employee_id = $request->employee_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('employee_id', $employee_id)
                    ->where('status', 'return')
                    ->get();
            }
        }
        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;
        foreach ($invoices as $invoice) {
            $sum_amount_total = round(($sum_amount_total + $invoice->amount_total), 2);
            $sum_total_weight = round(($sum_total_weight + $invoice->total_weight), 2);
            $sum_final_total = round(($sum_final_total + $invoice->final_total), 2);
            $sum_tax_total = round(($sum_tax_total + $invoice->tax_total), 2);
        }
        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.taxreturn.report3.view', compact('employees', 'branches', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function taxreturn_report3_print(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $employee_id = $request->employee_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('employee_id', $employee_id)
                    ->where('status', 'return')
                    ->get();
            }
        }
        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;
        foreach ($invoices as $invoice) {
            $sum_amount_total = round(($sum_amount_total + $invoice->amount_total), 2);
            $sum_total_weight = round(($sum_total_weight + $invoice->total_weight), 2);
            $sum_final_total = round(($sum_final_total + $invoice->final_total), 2);
            $sum_tax_total = round(($sum_tax_total + $invoice->tax_total), 2);
        }
        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.taxreturn.report3.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }


    public function taxreturn_report4_get()
    {
        $branches = Branch::all();
        $employees = Employee::all();
        return view('supervisor.reports.taxreturn.report4.view', compact('employees', 'branches'));
    }

    public function taxreturn_report4_post(Request $request)
    {
        $branches = Branch::all();
        $employees = Employee::all();
        $employee_id = $request->employee_id;
        $karat = $request->karat;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = TaxInvoiceElement::where('tax_id', $invoice->id)
                ->where('karat', $karat)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.taxreturn.report4.view', compact('branches', 'employees', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function taxreturn_report4_print(Request $request)
    {
        $employee_id = $request->employee_id;
        $karat = $request->karat;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = TaxInvoiceElement::where('tax_id', $invoice->id)
                ->where('karat', $karat)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.taxreturn.report4.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }


    public function taxreturn_report5_get()
    {
        $branches = Branch::all();
        $products = Product::all();
        return view('supervisor.reports.taxreturn.report5.view', compact('products', 'branches'));
    }

    public function taxreturn_report5_post(Request $request)
    {
        $branches = Branch::all();
        $products = Product::all();
        $product_id = $request->product_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = TaxInvoiceElement::where('tax_id', $invoice->id)
                ->where('product_id', $product_id)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.taxreturn.report5.view', compact('branches', 'products', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function taxreturn_report5_print(Request $request)
    {
        $product_id = $request->product_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = TaxInvoiceElement::where('tax_id', $invoice->id)
                ->where('product_id', $product_id)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.taxreturn.report5.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function taxreturn_report6_get()
    {
        $branches = Branch::all();
        $employees = Employee::all();
        $products = Product::all();
        return view('supervisor.reports.taxreturn.report6.view', compact('employees', 'products', 'branches'));
    }

    public function taxreturn_report6_post(Request $request)
    {
        $branches = Branch::all();
        $employees = Employee::all();
        $products = Product::all();
        $employee_id = $request->employee_id;
        $product_id = $request->product_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = TaxInvoiceElement::where('tax_id', $invoice->id)
                ->where('product_id', $product_id)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.taxreturn.report6.view', compact('branches', 'products', 'employees', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function taxreturn_report6_print(Request $request)
    {
        $employee_id = $request->employee_id;
        $product_id = $request->product_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = TaxInvoiceElement::where('tax_id', $invoice->id)
                ->where('product_id', $product_id)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.taxreturn.report6.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }


    public function taxreturn_report7_get()
    {
        $branches = Branch::all();
        return view('supervisor.reports.taxreturn.report7.view', compact('branches'));
    }

    public function taxreturn_report7_post(Request $request)
    {
        $branches = Branch::all();
        $min_gram_price = $request->min_gram_price;
        $max_gram_price = $request->max_gram_price;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = TaxInvoiceElement::where('tax_id', $invoice->id)
                ->whereBetween('gram_price', [$min_gram_price, $max_gram_price])
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.taxreturn.report7.view', compact('branches', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function taxreturn_report7_print(Request $request)
    {
        $min_gram_price = $request->min_gram_price;
        $max_gram_price = $request->max_gram_price;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->get();
            } else {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = TaxInvoiceElement::where('tax_id', $invoice->id)
                ->whereBetween('gram_price', [$min_gram_price, $max_gram_price])
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.taxreturn.report7.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }


    public function taxreturn_report8_get()
    {
        $branches = Branch::all();
        $employees = Employee::all();
        return view('supervisor.reports.taxreturn.report8.view', compact('employees', 'branches'));
    }

    public function taxreturn_report8_post(Request $request)
    {
        $branches = Branch::all();
        $employees = Employee::all();
        $min_gram_price = $request->min_gram_price;
        $max_gram_price = $request->max_gram_price;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $employee_id = $request->employee_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = TaxInvoiceElement::where('tax_id', $invoice->id)
                ->whereBetween('gram_price', [$min_gram_price, $max_gram_price])
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.taxreturn.report8.view', compact('branches', 'employees', 'sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));
    }

    public function taxreturn_report8_print(Request $request)
    {

        $min_gram_price = $request->min_gram_price;
        $max_gram_price = $request->max_gram_price;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        $employee_id = $request->employee_id;
        $payment_method = $request->payment_method;
        if ($branch_id == "all") {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        } else {
            if ($payment_method == "all") {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            } else {
                $invoices = TaxInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('payment_method', $payment_method)
                    ->where('status', 'return')
                    ->where('employee_id', $employee_id)
                    ->get();
            }
        }
        $elements = new Collection;
        foreach ($invoices as $invoice) {
            $element = TaxInvoiceElement::where('tax_id', $invoice->id)
                ->whereBetween('gram_price', [$min_gram_price, $max_gram_price])
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        $sum_total_weight = 0;
        $sum_final_total = 0;
        $sum_tax_total = 0;

        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
                $sum_total_weight = round(($sum_total_weight + $item->weight), 2);
                $sum_final_total = round(($sum_final_total + $item->total), 2);
                $sum_tax_total = round(($sum_tax_total + $item->tax), 2);
            }
        }

        if ($sum_total_weight == 0) {
            $sum_gram_price = 0;
        } else {
            $sum_gram_price = round(($sum_amount_total / $sum_total_weight), 2);
        }
        return view('supervisor.reports.taxreturn.report8.print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));

    }

    public function declaration_report1_get()
    {
        return view('supervisor.reports.declaration.report1.view');
    }

    public function declaration_report1_post(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $simplified_invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
            ->where('status', 'done')
            ->get();
        $tax_invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
            ->where('status', 'done')
            ->get();

        $elements = new Collection;
        foreach ($simplified_invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('tax', '!=', 0)
                ->get();
            $elements->push($element);
        }
        foreach ($tax_invoices as $invoice) {
            $element = TaxInvoiceElement::where('tax_id', $invoice->id)
                ->where('tax', '!=', 0)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
            }
        }
        return view('supervisor.reports.declaration.report1.view',
            compact('sum_amount_total'));
    }

    public function declaration_report1_print(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $simplified_invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
            ->where('status', 'done')
            ->get();
        $tax_invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
            ->where('status', 'done')
            ->get();

        $elements = new Collection;
        foreach ($simplified_invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('tax', '!=', 0)
                ->get();
            $elements->push($element);
        }
        foreach ($tax_invoices as $invoice) {
            $element = TaxInvoiceElement::where('tax_id', $invoice->id)
                ->where('tax', '!=', 0)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
            }
        }
        return view('supervisor.reports.declaration.report1.print',
            compact('sum_amount_total'));
    }


    public function declaration_report2_get()
    {
        return view('supervisor.reports.declaration.report2.view');
    }

    public function declaration_report2_post(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $simplified_invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
            ->where('status', 'return')
            ->get();
        $tax_invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
            ->where('status', 'return')
            ->get();

        $elements = new Collection;
        foreach ($simplified_invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('tax', '!=', 0)
                ->get();
            $elements->push($element);
        }
        foreach ($tax_invoices as $invoice) {
            $element = TaxInvoiceElement::where('tax_id', $invoice->id)
                ->where('tax', '!=', 0)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
            }
        }
        return view('supervisor.reports.declaration.report2.view',
            compact('sum_amount_total'));
    }

    public function declaration_report2_print(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $simplified_invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
            ->where('status', 'return')
            ->get();
        $tax_invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
            ->where('status', 'return')
            ->get();

        $elements = new Collection;
        foreach ($simplified_invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('tax', '!=', 0)
                ->get();
            $elements->push($element);
        }
        foreach ($tax_invoices as $invoice) {
            $element = TaxInvoiceElement::where('tax_id', $invoice->id)
                ->where('tax', '!=', 0)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
            }
        }
        return view('supervisor.reports.declaration.report2.print',
            compact('sum_amount_total'));
    }


    public function declaration_report3_get()
    {
        return view('supervisor.reports.declaration.report3.view');
    }

    public function declaration_report3_post(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $simplified_invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
            ->where('status', 'done')
            ->get();
        $tax_invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
            ->where('status', 'done')
            ->get();

        $elements = new Collection;
        foreach ($simplified_invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('tax', 0)
                ->get();
            $elements->push($element);
        }
        foreach ($tax_invoices as $invoice) {
            $element = TaxInvoiceElement::where('tax_id', $invoice->id)
                ->where('tax', 0)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
            }
        }
        return view('supervisor.reports.declaration.report3.view',
            compact('sum_amount_total'));
    }

    public function declaration_report3_print(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $simplified_invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
            ->where('status', 'done')
            ->get();
        $tax_invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
            ->where('status', 'done')
            ->get();

        $elements = new Collection;
        foreach ($simplified_invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('tax', 0)
                ->get();
            $elements->push($element);
        }
        foreach ($tax_invoices as $invoice) {
            $element = TaxInvoiceElement::where('tax_id', $invoice->id)
                ->where('tax', 0)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
            }
        }
        return view('supervisor.reports.declaration.report3.print',
            compact('sum_amount_total'));
    }


    public function declaration_report4_get()
    {
        return view('supervisor.reports.declaration.report4.view');
    }

    public function declaration_report4_post(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $simplified_invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
            ->where('status', 'return')
            ->get();
        $tax_invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
            ->where('status', 'return')
            ->get();

        $elements = new Collection;
        foreach ($simplified_invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('tax', 0)
                ->get();
            $elements->push($element);
        }
        foreach ($tax_invoices as $invoice) {
            $element = TaxInvoiceElement::where('tax_id', $invoice->id)
                ->where('tax', 0)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
            }
        }
        return view('supervisor.reports.declaration.report4.view',
            compact('sum_amount_total'));
    }

    public function declaration_report4_print(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $simplified_invoices = SimplifiedInvoice::whereBetween('date', [$from_date, $to_date])
            ->where('status', 'return')
            ->get();
        $tax_invoices = TaxInvoice::whereBetween('date', [$from_date, $to_date])
            ->where('status', 'return')
            ->get();

        $elements = new Collection;
        foreach ($simplified_invoices as $invoice) {
            $element = SimplifiedInvoiceElement::where('simplified_id', $invoice->id)
                ->where('tax', 0)
                ->get();
            $elements->push($element);
        }
        foreach ($tax_invoices as $invoice) {
            $element = TaxInvoiceElement::where('tax_id', $invoice->id)
                ->where('tax', 0)
                ->get();
            $elements->push($element);
        }

        $sum_amount_total = 0;
        foreach ($elements as $element) {
            foreach ($element as $item) {
                $sum_amount_total = round(($sum_amount_total + $item->amount), 2);
            }
        }
        return view('supervisor.reports.declaration.report4.print',
            compact('sum_amount_total'));
    }


    public function declaration_report5_get()
    {
        return view('supervisor.reports.declaration.report5.view');
    }

    public function declaration_report5_post(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $purchases_invoices = PurchaseInvoice::whereBetween('date', [$from_date, $to_date])->get();
        $sum_final_total = 0;
        $sum_tax_total = 0;
        foreach ($purchases_invoices as $invoice) {
            $sum_final_total = round(($sum_final_total + $invoice->final_total), 2);
            $sum_tax_total = round(($sum_tax_total + $invoice->tax_total), 2);
        }
        return view('supervisor.reports.declaration.report5.view',
            compact('sum_tax_total', 'sum_final_total'));
    }

    public function declaration_report5_print(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $purchases_invoices = PurchaseInvoice::whereBetween('date', [$from_date, $to_date])->get();
        $sum_final_total = 0;
        $sum_tax_total = 0;
        foreach ($purchases_invoices as $invoice) {
            $sum_final_total = round(($sum_final_total + $invoice->final_total), 2);
            $sum_tax_total = round(($sum_tax_total + $invoice->tax_total), 2);
        }
        return view('supervisor.reports.declaration.report5.print',
            compact('sum_tax_total', 'sum_final_total'));
    }


    public function declaration_report6_get()
    {
        return view('supervisor.reports.declaration.report6.view');
    }

    public function declaration_report6_post(Request $request)
    {
        $branches = Branch::all();
        return view('supervisor.reports.declaration.report6.view',
            compact('branches'));
    }

    public function declaration_report6_print(Request $request)
    {
        $branches = Branch::all();
        return view('supervisor.reports.declaration.report6.print',
            compact('branches'));
    }

    public function expenses_report_get()
    {
        $branches = Branch::all();
        return view('supervisor.reports.expenses.report1.view', compact('branches'));
    }

    public function expenses_report_post(Request $request)
    {
        $branches = Branch::all();
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        if ($branch_id == "all") {
            $expenses = Expense::whereBetween('date', [$from_date, $to_date])
                ->get();
        } else {
            $expenses = Expense::where('branch_id', $branch_id)
                ->whereBetween('date', [$from_date, $to_date])
                ->get();
        }
        $fixed = FixedExpense::all();
        return view('supervisor.reports.expenses.report1.view',
            compact('branches', 'expenses', 'fixed'));
    }

    public function expenses_report_print(Request $request)
    {
        $branches = Branch::all();
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $branch_id = $request->branch_id;
        if ($branch_id == "all") {
            $expenses = Expense::whereBetween('date', [$from_date, $to_date])
                ->get();
        } else {
            $expenses = Expense::where('branch_id', $branch_id)
                ->whereBetween('date', [$from_date, $to_date])
                ->get();
        }
        $fixed = FixedExpense::all();
        return view('supervisor.reports.expenses.report1.print',
            compact('branches', 'expenses', 'fixed'));
    }


}

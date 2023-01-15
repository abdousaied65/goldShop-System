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
use App\Models\Supervisor;
use App\Models\TaxInvoice;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:supervisor-web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $auth_id = Auth::user()->id;
        $user = Supervisor::findOrFail($auth_id);
        $roles = Role::where('guard_name', 'supervisor-web')->get();
        $supervisors = Supervisor::all();
        $branches = Branch::all();
        $products = Product::all();
        $employees = Employee::all();


        if (empty(Auth::user()->branch_id)) {
            $last_simplified_invoices = SimplifiedInvoice::where('status', 'done')
                ->latest()->paginate(5);
            $simplified_invoices = SimplifiedInvoice::where('status', 'done')
                ->get();
            $tax_invoices = TaxInvoice::where('status', 'done')
                ->get();
            $simplified_return_invoices = SimplifiedInvoice::where('status', 'return')
                ->get();
            $tax_return_invoices = TaxInvoice::where('status', 'return')
                ->get();
            $purchases_invoices = PurchaseInvoice::all();
            $expenses = Expense::all();
        } else {
            $branch_id = Auth::user()->branch_id;
            $last_simplified_invoices = SimplifiedInvoice::where('status', 'done')
                ->where('branch_id', $branch_id)
                ->latest()->paginate(5);
            $simplified_invoices = SimplifiedInvoice::where('status', 'done')
                ->where('branch_id', $branch_id)
                ->get();
            $tax_invoices = TaxInvoice::where('status', 'done')
                ->where('branch_id', $branch_id)
                ->get();
            $simplified_return_invoices = SimplifiedInvoice::where('status', 'return')
                ->where('branch_id', $branch_id)
                ->get();
            $tax_return_invoices = TaxInvoice::where('status', 'return')
                ->where('branch_id', $branch_id)
                ->get();
            $purchases_invoices = PurchaseInvoice::where('branch_id', $branch_id)->get();
            $expenses = Expense::where('branch_id', $branch_id)->get();
        }
        $fixed_expenses = FixedExpense::all();

        return view('supervisor.home', compact('user', 'roles', 'supervisors', 'branches',
            'products', 'employees', 'simplified_invoices', 'tax_invoices', 'simplified_return_invoices',
            'tax_return_invoices', 'purchases_invoices', 'last_simplified_invoices', 'fixed_expenses', 'expenses'));
    }

    public function lock_screen()
    {
        return view('supervisor.lockscreen');
    }

    public function get_sales_details(Request $request)
    {
        $today = date('Y-m-d');
        $branches = Branch::all();
        echo '
        <div class="results row mt-1 mb-3 p-3">

            <table class="table table-condensed table-bordered text-center table-striped table-hover">
                <thead>

                <tr>
                    <th style="font-size: 16px!important;">
                        اسم الفرع
                    </th>
                    <th style="font-size: 16px!important;">
                        اجمالى المبيعات
                    </th>
                </tr>
                <tr>
                    <td colspan="2" style="background-color:white!important;font-size:16px!important;">
                        '.$today.'
                    </td>
                </tr>
                </thead>
                <tbody>';
        foreach($branches as $branch){
            $simplified_invoices = \App\Models\SimplifiedInvoice::where('date', $today)
                ->where('status', 'done')
                ->where('branch_id', $branch->id)
                ->get();
            $tax_invoices = \App\Models\TaxInvoice::where('date', $today)
                ->where('status', 'done')
                ->where('branch_id', $branch->id)
                ->get();
            $sum_final_total = 0;
            foreach ($simplified_invoices as $invoice) {
                $sum_final_total = round(($sum_final_total + $invoice->final_total), 2);
            }
            foreach ($tax_invoices as $invoice) {
                $sum_final_total = round(($sum_final_total + $invoice->final_total), 2);
            }
            echo '
                    <tr>
                        <td class="tx-16">
                            '.$branch->branch_name.'
                        </td>
                        <td class="tx-16">'.$sum_final_total.'</td>
                    </tr>';
        }
        echo '
                </tbody>
            </table>
        </div>';
    }
    
    
    public function get_sales_details_2(Request $request)
    {
        $from_date = date('Y-m-d');
        $to_date = date('Y-m-d');
        $auth_id = Auth::user()->id;
        $user = Supervisor::findOrFail($auth_id);
        $branch = $user->branch;
        $branch_id = $branch->id;
        $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
        
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
    
        echo '
        <div class="results row mt-1 mb-3 p-3">
            <table class="table w-100 table-bordered table-striped table-condensed table-hover" dir="rtl">
                <tr>
                    <td>
                        مجموع المبلغ ( بدون ضريبة )
                    </td>
                    <td>'.$sum_amount_total.'</td>
                </tr>
                <tr>
                    <td>
                        مجموع الذهب
                        ( مجموع الاوزان )
                    </td>
                    <td>'.$sum_total_weight.'</td>
                </tr>
                <tr>
                    <td>
                        الأجمالي للمبلغ ( شامل الضريبة )
                    </td>
                    <td>'.$sum_final_total.'</td>
                </tr>
                <tr>
                    <td>
                        اجمالى الضريبة
                    </td>
                    <td>'.$sum_tax_total.'</td>
                </tr>
                <tr>
                    <td>
                        سعر الجرام
                    </td>
                    <td>'.$sum_gram_price.'</td>
                </tr>
            </table>
        </div>';
    }
    
    public function report_print(Request $request)
    {
        $from_date = date('Y-m-d');
        $to_date = date('Y-m-d');
        $auth_id = Auth::user()->id;
        $user = Supervisor::findOrFail($auth_id);
        $branch = $user->branch;
        $branch_id = $branch->id;
        
        $invoices = SimplifiedInvoice::where('branch_id', $branch_id)
                    ->whereBetween('date', [$from_date, $to_date])
                    ->where('status', 'done')
                    ->get();
        
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
        
        return view('supervisor.report_print', compact('sum_amount_total', 'sum_final_total', 'sum_gram_price', 'sum_tax_total', 'sum_total_weight'));

    }
    
    

}

<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\SimplifiedInvoice;
use App\Models\SimplifiedReturn;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SimplifiedReturnController extends Controller
{
    public function index(Request $request)
    {
        if (empty(Auth::user()->branch_id)) {
            $data = SimplifiedReturn::all();
        } else {
            $data = SimplifiedReturn::where('branch_id', Auth::user()->branch_id)->get();
        }
        $branches = Branch::all();
        return view('supervisor.simplified_return.index', compact('data', 'branches'));
    }

    public function create()
    {
        $check = SimplifiedReturn::all();
        if ($check->isEmpty()) {
            $unified_serial_number = 1;
        } else {
            $old_pre_counter = SimplifiedReturn::max('unified_serial_number');
            $unified_serial_number = $old_pre_counter + 1;
        }
        if (empty(Auth::user()->branch_id)) {
            $simplified_invoices = SimplifiedInvoice::where('status', 'done')->get();
        } else {
            $simplified_invoices = SimplifiedInvoice::where('branch_id', Auth::user()->branch_id)
                ->where('status', 'done')->get();
        }
        $branches = Branch::all();
        $employees = Employee::all();
        return view('supervisor.simplified_return.create', compact('unified_serial_number','employees','branches','simplified_invoices'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $return = SimplifiedReturn::create($data);
        $return->simplified->update([
            'status' => 'return',
        ]);
        return redirect()->route('supervisor.simplified_return.create')
            ->with('success', 'تمت الاضافة بنجاح');
    }

    public function get_simplified_details(Request $request)
    {
        $simplified_id = $request->simplified_id;
        $simplified = SimplifiedInvoice::FindOrFail($simplified_id);

        echo "<table class='table table-bordered table-condensed table-striped'>";
        echo '<thead>
            <tr>
                <th class="border-bottom-0 text-center">
                    رقم الفاتورة
                </th>
                <th class="border-bottom-0 text-center">
                    تاريخ - وقت
                </th>
                <th class="border-bottom-0 text-center">
                    طريقة الدفع
                </th>
                <th class="border-bottom-0 text-center">
                    الفرع
                </th>
                <th class="border-bottom-0 text-center">
                    الموظف
                </th>
                <th class="border-bottom-0 text-center">
                    الضريبة
                </th>
                <th class="border-bottom-0 text-center">
                    الاجمالى
                </th>
            </tr>
            </thead>';
        echo '<tbody>
                <tr>
                    <td>' . $simplified->unified_serial_number . '</td>
                    <td>' . $simplified->date . ' - ' . $simplified->time . ' </td>
                    <td>';
        if ($simplified->payment_method == "cash")
            echo $simplified->cash_amount . ' كاش';
        elseif ($simplified->payment_method == "visa")
            echo $simplified->visa_amount . ' فيزا';
        else
            echo $simplified->cash_amount . ' كاش +
                                        ' . $simplified->visa_amount . ' فيزا';
        echo '</td>
                                <td>';
        if (empty($simplified->branch_id))
            echo 'كل الفروع';

        else
            echo $simplified->branch->branch_name;

        echo '</td>
                    <td>' . $simplified->employee->name . '</td>
                    <td>' . $simplified->tax_total . '</td>
                    <td>' . $simplified->final_total . '</td>
                </tr>
            </tbody>';
        echo "</table>";
    }

}

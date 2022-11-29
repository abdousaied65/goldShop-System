<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\SimplifiedInvoice;
use App\Models\SimplifiedReturn;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SimplifiedReturnController extends Controller
{
    public function index(Request $request)
    {
        $auth_id = Auth::user()->id;
        if (Auth::user()->role_name == "مدير النظام") {
            $data = SimplifiedReturn::all();
        } else {
            $data = SimplifiedReturn::where('supervisor_id', $auth_id)->get();
        }
        return view('supervisor.simplified_return.index', compact('data'));
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
        $simplified_invoices = SimplifiedInvoice::where('status','done')->get();
        return view('supervisor.simplified_return.create', compact('unified_serial_number', 'simplified_invoices'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $supervisor_id = Auth::user()->id;
        $supervisor = Supervisor::FindOrFail($supervisor_id);
        $branch_id = $supervisor->branch_id;
        $data['branch_id'] = $branch_id;
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
                    <td>' . $simplified->supervisor->name . '</td>
                    <td>' . $simplified->tax_total . '</td>
                    <td>' . $simplified->final_total . '</td>
                </tr>
            </tbody>';
        echo "</table>";
    }

}

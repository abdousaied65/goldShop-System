<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\TaxInvoice;
use App\Models\TaxReturn;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TaxReturnController extends Controller
{
    public function index(Request $request)
    {
        $auth_id = Auth::user()->id;
        if (Auth::user()->role_name == "مدير النظام") {
            $data = TaxReturn::all();
        } else {
            $data = TaxReturn::where('supervisor_id', $auth_id)->get();
        }
        return view('supervisor.tax_return.index', compact('data'));
    }

    public function create()
    {
        $check = TaxReturn::all();
        if ($check->isEmpty()) {
            $unified_serial_number = 1;
        } else {
            $old_pre_counter = TaxReturn::max('unified_serial_number');
            $unified_serial_number = $old_pre_counter + 1;
        }
        $tax_invoices = TaxInvoice::where('status', 'done')->get();
        return view('supervisor.tax_return.create', compact('unified_serial_number', 'tax_invoices'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $supervisor_id = Auth::user()->id;
        $supervisor = Supervisor::FindOrFail($supervisor_id);
        $branch_id = $supervisor->branch_id;
        $data['branch_id'] = $branch_id;
        $return = TaxReturn::create($data);
        $return->tax->update([
            'status' => 'return',
        ]);
        return redirect()->route('supervisor.tax_return.create')
            ->with('success', 'تمت الاضافة بنجاح');
    }

    public function get_tax_details(Request $request)
    {
        $tax_id = $request->tax_id;
        $tax = TaxInvoice::FindOrFail($tax_id);

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
                    اسم الشركة او المؤسسة
                </th>
                <th class="border-bottom-0 text-center">
                    الرقم الضريبى للشركة
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
                    <td>' . $tax->unified_serial_number . '</td>
                    <td>' . $tax->date . ' - ' . $tax->time . ' </td>
                    <td>' . $tax->company_name . '</td>
                    <td>' . $tax->company_tax_number . '</td>
                    <td>';
        if ($tax->payment_method == "cash")
            echo $tax->cash_amount . ' كاش';
        elseif ($tax->payment_method == "visa")
            echo $tax->visa_amount . ' فيزا';
        else
            echo $tax->cash_amount . ' كاش +
                                        ' . $tax->visa_amount . ' فيزا';
        echo '</td>
                                <td>';
        if (empty($tax->branch_id))
            echo 'كل الفروع';

        else
            echo $tax->branch->branch_name;

        echo '</td>
                    <td>' . $tax->supervisor->name . '</td>
                    <td>' . $tax->tax_total . '</td>
                    <td>' . $tax->final_total . '</td>
                </tr>
            </tbody>';
        echo "</table>";
    }

}

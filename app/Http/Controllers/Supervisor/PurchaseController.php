<?php

namespace App\Http\Controllers\Supervisor;

use App\Exports\PurchaseExport;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\PurchaseInvoice;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        if (empty(Auth::user()->branch_id)) {
            $data = PurchaseInvoice::all();
        } else {
            $data = PurchaseInvoice::where('branch_id', Auth::user()->branch_id)->get();
        }
        $branches = Branch::all();
        return view('supervisor.purchase.index', compact('data','branches'));
    }

    public function search(Request $request)
    {
        $branch_id = $request->branch_id;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $data = PurchaseInvoice::where('branch_id',$branch_id)
            ->whereBetween('date', [$from_date, $to_date])
            ->get();
        $branches = Branch::all();
        return view('supervisor.purchase.index', compact('data','branch_id','from_date','to_date','branches'));
    }


    public function create()
    {
        $branches = Branch::all();
        if (empty(Auth::user()->branch_id)) {
            $employees = Employee::all();
        } else {
            $employees = Employee::where('branch_id', Auth::user()->branch_id)->get();
        }
        return view('supervisor.purchase.create',compact('branches','employees'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'invoice_number' => 'required',
            'date' => 'required',
            'tax_total' => 'required',
            'final_total' => 'required',
            'attachment' => 'required',
        ]);
        $data = $request->all();
        $purchase = PurchaseInvoice::create($data);
        if ($request->hasFile('attachment')) {
            $image = $request->file('attachment');
            $fileName = $image->getClientOriginalName();
            $uploadDir = 'uploads/purchases/attachments/' . $purchase->id;
            $image->move($uploadDir, $fileName);
            $purchase->attachment = $uploadDir . '/' . $fileName;
            $purchase->save();
        }
        return redirect()->route('supervisor.purchases.index')
            ->with('success', 'تم اضافة فاتورة مشتريات بنجاح');
    }


    public function edit($id)
    {
        $purchase = PurchaseInvoice::findOrFail($id);
        $branch = $purchase->branch;
        $branches = Branch::all();
        $employees = Employee::where('branch_id', $branch->id)->get();
        return view('supervisor.purchase.edit', compact('purchase','branches','employees'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'invoice_number' => 'required',
            'date' => 'required',
            'tax_total' => 'required',
            'final_total' => 'required',
        ]);
        $data = $request->all();
        $purchase = PurchaseInvoice::findOrFail($id);
        $purchase->update($data);
        if ($request->hasFile('attachment')) {
            $image = $request->file('attachment');
            $fileName = $image->getClientOriginalName();
            $uploadDir = 'uploads/purchases/attachments/' . $purchase->id;
            $image->move($uploadDir, $fileName);
            $purchase->attachment = $uploadDir . '/' . $fileName;
            $purchase->save();
        }
        return redirect()->route('supervisor.purchases.index')
            ->with('success', 'تم تعديل بيانات فاتورة المشتريات بنجاح');
    }

    public function print_selected()
    {
        if (empty(Auth::user()->branch_id)) {
            $purchases = PurchaseInvoice::all();
        } else {
            $purchases = PurchaseInvoice::where('branch_id', Auth::user()->branch_id)->get();
        }
        return view('supervisor.purchase.print', compact('purchases'));
    }

    public function export_purchases_excel()
    {
        return Excel::download(new PurchaseExport(), 'كل فواتير المشتريات.xlsx');
    }
}

<?php

namespace App\Http\Controllers\Supervisor;

use App\Exports\PurchaseExport;
use App\Models\Branch;
use App\Models\PurchaseInvoice;
use App\Http\Controllers\Controller;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $auth_id = Auth::user()->id;
        if(Auth::user()->role_name == "مدير النظام"){
            $data = PurchaseInvoice::all();
        }
        else{
            $data = PurchaseInvoice::where('supervisor_id',$auth_id)->get();
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
        return view('supervisor.purchase.create');
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
        $supervisor_id = Auth::user()->id;
        $supervisor = Supervisor::FindOrFail($supervisor_id);
        $branch_id = $supervisor->branch_id;
        $data['branch_id'] = $branch_id;
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
        return view('supervisor.purchase.edit', compact('purchase'));
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
        $supervisor_id = Auth::user()->id;
        $supervisor = Supervisor::FindOrFail($supervisor_id);
        $branch_id = $supervisor->branch_id;
        $data['branch_id'] = $branch_id;
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
        $purchases = PurchaseInvoice::all();
        return view('supervisor.purchase.print', compact('purchases'));
    }

    public function export_purchases_excel()
    {
        return Excel::download(new PurchaseExport(), 'كل فواتير المشتريات.xlsx');
    }
}

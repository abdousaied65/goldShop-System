<?php

namespace App\Http\Controllers\Supervisor;

use App\Exports\FixedExport;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\FixedExpense;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class FixedController extends Controller
{
    public function index(Request $request)
    {
        if (empty(Auth::user()->branch_id)) {
            $data = FixedExpense::all();
        } else {
            $branch = Branch::FindOrFail(Auth::user()->branch_id);
            $data = $branch->fixed_expenses;
        }
        return view('supervisor.fixed.index', compact('data'));
    }

    public function create()
    {
        return view('supervisor.fixed.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'supervisor_id' => 'required',
            'fixed_expense' => 'required',
        ]);
        $input = $request->all();
        $fixed = FixedExpense::create($input);
        return redirect()->route('supervisor.fixed.index')
            ->with('success', 'تم اضافة مصروف ثابت بنجاح');
    }

    public function show($id)
    {
        $fixed = FixedExpense::findorfail($id);
        return view('supervisor.fixed.show', compact('fixed'));
    }


    public function edit($id)
    {
        $fixed = FixedExpense::findOrFail($id);
        return view('supervisor.fixed.edit', compact('fixed'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'supervisor_id' => 'required',
            'fixed_expense' => 'required',
        ]);
        $input = $request->all();
        $fixed = FixedExpense::findOrFail($id);
        $fixed->update($input);
        return redirect()->route('supervisor.fixed.index')
            ->with('success', 'تم تعديل بيانات المصروف الثابت بنجاح');
    }

    public function destroy(Request $request)
    {
        FixedExpense::findOrFail($request->fixed_id)->delete();
        return redirect()->route('supervisor.fixed.index')
            ->with('success', 'تم حذف المصروف الثابت بنجاح');
    }

    public function remove_selected(Request $request)
    {
        $fixed_ids = $request->fixed;
        foreach ($fixed_ids as $fixed_id) {
            $fixed = FixedExpense::FindOrFail($fixed_id);
            $fixed->delete();
        }
        return redirect()->route('supervisor.fixed.index')
            ->with('success', 'تم الحذف بنجاح');
    }

    public function print_selected()
    {
        if (empty(Auth::user()->branch_id)) {
            $fixed = FixedExpense::all();
        } else {
            $branch = Branch::FindOrFail(Auth::user()->branch_id);
            $fixed = $branch->fixed;
        }
        return view('supervisor.fixed.print', compact('fixed'));
    }

    public function export_fixed_excel()
    {
        return Excel::download(new FixedExport(), 'كل المصاريف الثابتة.xlsx');
    }
}

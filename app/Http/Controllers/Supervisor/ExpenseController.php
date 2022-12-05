<?php

namespace App\Http\Controllers\Supervisor;

use App\Exports\ExpenseExport;
use App\Models\Branch;
use App\Models\Expense;
use App\Http\Controllers\Controller;
use App\Models\FixedExpense;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        if (empty(Auth::user()->branch_id)) {
            $data = Expense::all();
        } else {
            $branch = Branch::FindOrFail(Auth::user()->branch_id);
            $data = $branch->expenses;
        }
        return view('supervisor.expenses.index', compact('data'));
    }

    public function create()
    {
        $check = Expense::all();
        if ($check->isEmpty()) {
            $unified_serial_number = 1;
        } else {
            $old_pre_counter = Expense::max('unified_serial_number');
            $unified_serial_number = $old_pre_counter + 1;
        }
        $fixed = FixedExpense::all();
        return view('supervisor.expenses.create', compact('fixed', 'unified_serial_number'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'branch_id' => 'required',
            'supervisor_id' => 'required',
            'fixed_id' => 'required',
            'unified_serial_number' => 'required',
            'date' => 'required',
            'expense_details' => 'required',
            'amount' => 'required',
        ]);
        $input = $request->all();
        $expense = Expense::create($input);
        if ($request->hasFile('expense_pic')) {
            $image = $request->file('expense_pic');
            $fileName = $image->getClientOriginalName();
            $uploadDir = 'uploads/expenses/' . $expense->id;
            $image->move($uploadDir, $fileName);
            $expense->expense_pic = $uploadDir . '/' . $fileName;
            $expense->save();
        }

        return redirect()->route('supervisor.expense.index')
            ->with('success', 'تم اضافة مصروف بنجاح');
    }

    public function show($id)
    {
        $expense = Expense::findorfail($id);
        return view('supervisor.expenses.show', compact('expense'));
    }


    public function edit($id)
    {
        $fixed = FixedExpense::all();
        $expense = Expense::findOrFail($id);
        return view('supervisor.expenses.edit', compact('expense','fixed'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'branch_id' => 'required',
            'supervisor_id' => 'required',
            'fixed_id' => 'required',
            'unified_serial_number' => 'required',
            'date' => 'required',
            'expense_details' => 'required',
            'amount' => 'required',
        ]);
        $input = $request->all();
        $expense = Expense::findOrFail($id);
        $expense->update($input);
        if ($request->hasFile('expense_pic')) {
            $image = $request->file('expense_pic');
            $fileName = $image->getClientOriginalName();
            $uploadDir = 'uploads/expenses/' . $expense->id;
            $image->move($uploadDir, $fileName);
            $expense->expense_pic = $uploadDir . '/' . $fileName;
            $expense->save();
        }
        return redirect()->route('supervisor.expense.index')
            ->with('success', 'تم تعديل بيانات المصروف بنجاح');
    }

    public function destroy(Request $request)
    {
        Expense::findOrFail($request->expense_id)->delete();
        return redirect()->route('supervisor.expense.index')
            ->with('success', 'تم حذف المصروف بنجاح');
    }

    public function remove_selected(Request $request)
    {
        $expenses_id = $request->expenses;
        foreach ($expenses_id as $expense_id) {
            $expense = Expense::FindOrFail($expense_id);
            $expense->delete();
        }
        return redirect()->route('supervisor.expense.index')
            ->with('success', 'تم الحذف بنجاح');
    }

    public function print_selected()
    {
        if (empty(Auth::user()->branch_id)) {
            $expenses = Expense::all();
        } else {
            $branch = Branch::FindOrFail(Auth::user()->branch_id);
            $expenses = $branch->expenses;
        }
        return view('supervisor.expenses.print', compact('expenses'));
    }

    public function export_expenses_excel()
    {
        return Excel::download(new ExpenseExport(), 'كل المصروفات.xlsx');
    }
}

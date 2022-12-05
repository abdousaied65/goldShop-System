<?php

namespace App\Http\Controllers\Supervisor;

use App\Exports\EmployeesExport;
use App\Models\Branch;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if (empty(Auth::user()->branch_id)) {
            $data = Employee::all();
        } else {
            $branch = Branch::FindOrFail(Auth::user()->branch_id);
            $data = $branch->employees;
        }
        return view('supervisor.employees.index', compact('data'));
    }

    public function create()
    {
//        if (empty(Auth::user()->branch_id)) {
//            $branches = Branch::all();
//            $employees = Employee::all();
//        } else {
//            $branch = Branch::FindOrFail(Auth::user()->branch_id);
//            $employees = $branch->employees;
//        }
        return view('supervisor.employees.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'branch_id' => 'required',
            'name' => 'required',
        ]);
        $input = $request->all();
        $employee = Employee::create($input);
        return redirect()->route('supervisor.employees.index')
            ->with('success', 'تم اضافة موظف بنجاح');
    }

    public function show($id)
    {
        $employee = Employee::findorfail($id);
        return view('supervisor.employees.show', compact('employee'));
    }


    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('supervisor.employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'branch_id' => 'required',
            'name' => 'required',
        ]);
        $input = $request->all();
        $employee = Employee::findOrFail($id);
        $employee->update($input);
        return redirect()->route('supervisor.employees.index')
            ->with('success', 'تم تعديل بيانات الموظف بنجاح');
    }

    public function destroy(Request $request)
    {
        Employee::findOrFail($request->employee_id)->delete();
        return redirect()->route('supervisor.employees.index')
            ->with('success', 'تم حذف الموظف بنجاح');
    }

    public function remove_selected(Request $request)
    {
        $employees_id = $request->employees;
        foreach ($employees_id as $employee_id) {
            $employee = Employee::FindOrFail($employee_id);
            $employee->delete();
        }
        return redirect()->route('supervisor.employees.index')
            ->with('success', 'تم الحذف بنجاح');
    }

    public function print_selected()
    {
        if (empty(Auth::user()->branch_id)) {
            $employees = Employee::all();
        } else {
            $branch = Branch::FindOrFail(Auth::user()->branch_id);
            $employees = $branch->employees;
        }
        return view('supervisor.employees.print', compact('employees'));
    }

    public function export_employees_excel()
    {
        return Excel::download(new EmployeesExport(), 'كل الموظفين.xlsx');
    }
}

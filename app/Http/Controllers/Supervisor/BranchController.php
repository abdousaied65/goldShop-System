<?php

namespace App\Http\Controllers\Supervisor;

use App\Exports\BranchesExport;
use App\Models\Branch;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        $data = Branch::all();
        return view('supervisor.branches.index', compact('data'));
    }

    public function create()
    {
        return view('supervisor.branches.create');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'branch_name' => 'required'
        ]);
        $input = $request->all();
        $branch = Branch::create($input);
        return redirect()->route('supervisor.branches.index')
            ->with('success', 'تم اضافة فرع بنجاح');
    }

    public function show($id)
    {
        $branch = Branch::findorfail($id);
        return view('supervisor.branches.show', compact('branch'));
    }


    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('supervisor.branches.edit', compact('branch'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'branch_name' => 'required'
        ]);
        $input = $request->all();
        $branch = Branch::findOrFail($id);
        $branch->update($input);
        return redirect()->route('supervisor.branches.index')
            ->with('success', 'تم تعديل بيانات الفرع بنجاح');
    }

    public function destroy(Request $request)
    {
        Branch::findOrFail($request->branch_id)->delete();
        return redirect()->route('supervisor.branches.index')
            ->with('success', 'تم حذف الفرع بنجاح');
    }

    public function remove_selected(Request $request)
    {
        $branches_id = $request->branches;
        foreach ($branches_id as $branch_id) {
            $branch = Branch::FindOrFail($branch_id);
            $branch->delete();
        }
        return redirect()->route('supervisor.branches.index')
            ->with('success', 'تم الحذف بنجاح');
    }

    public function print_selected()
    {
        $branches = Branch::all();
        return view('supervisor.branches.print', compact('branches'));
    }

    public function export_branches_excel()
    {
        return Excel::download(new BranchesExport(), 'كل الفروع.xlsx');
    }
}

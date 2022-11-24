<?php

namespace App\Http\Controllers\Supervisor;

use App\Exports\SupervisorsExport;
use App\Models\Branch;
use App\Models\Supervisor;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function edit_profile($id)
    {
        $user = Supervisor::findOrFail($id);
        return view('supervisor.profiles.edit', compact('user'));
    }

    public function update_profile(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'same:confirm-password'
        ]);
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input, array('password'));
        }
        $user = Supervisor::findOrFail($id);
        $user->update($input);
        if ($request->hasFile('profile_pic')) {
            $profile_pic = $request->file('profile_pic');
            $fileName = $profile_pic->getClientOriginalName();
            $uploadDir = 'uploads/profiles/supervisors/' . $id;
            $profile_pic->move($uploadDir, $fileName);
            $user->profile_pic = $uploadDir . '/' . $fileName;
            $user->save();
        }
        return redirect()->back()->with('success', 'تم تحديث البيانات الشخصية بنجاح ');
    }


    public function index(Request $request)
    {
        $data = Supervisor::all();
        $roles = Role::get()->pluck('name', 'name');
        return view('supervisor.supervisors.index', compact('data', 'roles'));
    }

    public function create()
    {
        $roles = Role::where('guard_name', 'supervisor-web')
            ->get()->pluck('name', 'name');
        $branches = Branch::all();
        return view('supervisor.supervisors.create', compact('roles','branches'));

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:confirm-password',
            'role_name' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $supervisor = Supervisor::create($input);
        $supervisor->assignRole($request->input('role_name'));
        if ($request->hasFile('profile_pic')) {
            $image = $request->file('profile_pic');
            $fileName = $image->getClientOriginalName();
            $uploadDir = 'uploads/profiles/supervisors/' . $supervisor->id;
            $image->move($uploadDir, $fileName);
            $supervisor->profile_pic = $uploadDir . '/' . $fileName;
            $supervisor->save();
        }
        return redirect()->route('supervisor.supervisors.index')
            ->with('success', 'تم اضافة مستخدم بنجاح');
    }

    public function show($id)
    {
        $supervisor = Supervisor::findorfail($id);
        return view('supervisor.supervisors.show', compact('supervisor'));
    }


    public function edit($id)
    {
        $supervisor = Supervisor::findOrFail($id);
        $roles = Role::where('guard_name', 'supervisor-web')
            ->get()->pluck('name', 'name');
        $branches = Branch::all();
        $supervisorRole = $supervisor->roles->pluck('name', 'name')->all();
        return view('supervisor.supervisors.edit', compact('supervisor', 'roles','branches', 'supervisorRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'same:confirm-password',
            'role_name' => 'required'
        ]);
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input, array('password'));
        }
        $supervisor = Supervisor::findOrFail($id);
        $supervisor->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $supervisor->assignRole($request->input('role_name'));
        if ($request->hasFile('profile_pic')) {
            $image = $request->file('profile_pic');
            $fileName = $image->getClientOriginalName();
            $uploadDir = 'uploads/profiles/supervisors/' . $supervisor->id;
            $image->move($uploadDir, $fileName);
            $supervisor->profile_pic = $uploadDir . '/' . $fileName;
            $supervisor->save();
        }
        return redirect()->route('supervisor.supervisors.index')
            ->with('success', 'تم تعديل بيانات المستخدم بنجاح');
    }

    public function destroy(Request $request)
    {
        Supervisor::findOrFail($request->supervisor_id)->delete();
        return redirect()->route('supervisor.supervisors.index')
            ->with('success', 'تم حذف المستخدم بنجاح');
    }

    public function remove_selected(Request $request)
    {
        $supervisors_id = $request->supervisors;
        foreach ($supervisors_id as $supervisor_id) {
            $supervisor = Supervisor::FindOrFail($supervisor_id);
            $supervisor->delete();
        }
        return redirect()->route('supervisor.supervisors.index')
            ->with('success', 'تم الحذف بنجاح');
    }

    public function print_selected()
    {
        $supervisors = Supervisor::all();
        return view('supervisor.supervisors.print', compact('supervisors'));
    }

    public function export_supervisors_excel()
    {
        return Excel::download(new SupervisorsExport(), 'كل المستخدمين.xlsx');
    }
}

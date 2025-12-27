<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    //
    public function index()
    {
           Gate::authorize('admins.view');
        return view('dashboard.pages.admins.index',[
           'admins' => Admin::with('roles')->get(),
        ]);
    }
    public function create()
    {
           Gate::authorize('admins.create');
        return view('dashboard.pages.admins.create',[
            'roles' =>Role::all(),
            'admin' => new Admin(),
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8',
            'roles'    => 'required|array',
        ]);

        // إنشاء الأدمن بالحقول المسموح بها
        $admin = Admin::create([
            'name'     => $data['name'],
            'email'    => $data['email'],               
            'password' => Hash::make($data['password']), 
        ]);

        $admin->roles()->attach($data['roles']);
//$admin->roles()->attach(1,2,3)
        return redirect()->route('admins.index');
    }

    public function edit(Admin $admin)
    {
           Gate::authorize('admins.edit');
        return view('dashboard.pages.admins.edit',[
            'admin' => $admin,
            'roles' => Role::all(),
            'admin_roles' => $admin->roles()->pluck('id')->toArray(),
        ]);
    }
    public function update(Request $request, Admin $admin)
    {
           Gate::authorize('admins.update');
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ['required','email'],
            'password' => 'nullable|string|min:8',
            'roles'    => 'required|array',
        ]);

        $update = [
            'name'  => $data['name'],
            'email' => $data['email'],
        ];

        if (!empty($data['password'])) {
            $update['password'] = Hash::make($data['password']);
        }

        $admin->update($update);
        $admin->roles()->sync($data['roles']);
        //admin role_(1,2)
//  $admin->roles()->sync(3)
// sync : طابق بالضبط على الرولز اضف الجديد واحذف الزائد الغير محدد
// attach :اضف فقط لا تمسح القديمين
        return redirect()->route('admins.index');
    }
    public function destroy(Admin $admin)
{
           Gate::authorize('admins.destroy');
    $admin->roles()->detach();
    $admin->delete();

    // مثال فلاش ميسج (لو عندك كومبوننت أو سشن)
    // return redirect()->route('dashboard.admins.index')->with('delete', 'Admin deleted successfully.');

    return redirect()->route('admins.index');
}

}

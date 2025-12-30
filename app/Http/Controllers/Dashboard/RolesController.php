<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleAbility;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnValue;

class RolesController extends Controller
{
    //  public function __construct()
    // {
    //     $this->authorizeResource(Role::class ,'role'); // في حال استخدمنا resource 
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        Gate::authorize('roles.view');
        $roles = Role::paginate(5);
        return view('dashboard.pages.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        Gate::authorize('roles.create');
        return view('dashboard.pages.roles.create',
        [
            'role' => new Role(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'name' => 'required',
            'abilities' => 'required|array',
        ]);
        $role = Role::createWithAbilities($request);
        return redirect()->route('roles.index')
        ->with('success','Role created successfully');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
        Gate::authorize('roles.update');
        $role_abilities = $role->abilities()->pluck('type','ability')->toArray();
        // اول باراميتر بكون الفاليو والثاني بكون ال كي
        // type value
        // ability key 0 1 2 3 4 5 6 7 8 9 10

        return view('dashboard.pages.roles.edit',compact('role_abilities','role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role )
    {
        //

        
        $role->updateWithAbilities($request);
        return redirect()
        ->route('roles.index')
        ->with('success','Role updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Gate::authorize('roles.delete');
        Role::destroy($id);
        return redirect()->route('roles.index')
        ->with('danger','Role deleted successfully');
    }
}

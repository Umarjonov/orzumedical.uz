<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        abort_if (!auth()->user()->can('roles.show'),403);

        if (auth()->user()->hasRole('Super Admin'))
            $roles = Role::with('permissions')->get();
        else
            $roles = Role::where('name','!=','Super Admin')->with('permissions')->get();

        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if (!auth()->user()->can('roles.create'),403);
        $permissions = Permission::all();
        return view('admin.roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if (!auth()->user()->can('roles.store'),403);

        $this->validate($request,[
            'name' => 'required|unique:roles'
        ]);

        $role = Role::create([
            'name' => $request->get('name')
        ]);

        $permissions = $request->get('permissions');
        if ($permissions)
        {
            foreach ($permissions as $key => $item) {
                $role->givePermissionTo($item);
            }
        }
        message_set("Role created successfully",'success',5);

        return redirect()->route('roles.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $role = $role;
        $rolePermissions = $role->permissions;

        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit2($id)
    {
        abort_if(!auth()->user()->can('roles.edit'),403);
        $role = Role::findById($id);

        abort_if ($role->name == 'Super Admin' && !auth()->user()->hasRole('Super Admin'),403);
        $permissions = Permission::all();

        return view('pages.roles.edit',compact('role','permissions'));
    }
    public function edit(Role $role)
    {
        abort_if(!auth()->user()->can('roles.edit'),403);
        $role = $role;
        abort_if ($role->name == 'Super Admin' && !auth()->user()->hasRole('Super Admin'),403);

        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $permissions = Permission::get();

        return view('admin.roles.edit', compact('role', 'rolePermissions', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Role $role, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'permissions' => 'required',
        ]);
        abort_if ($role->name == 'Super Admin' && !auth()->user()->hasRole('Super Admin'),403);

        $role->update($request->only('name'));

        $role->syncPermissions($request->get('permissions'));
        message_set("Role updated successfully",'success',5);

        return redirect()->route('roles.index')
            ->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        abort_if (!auth()->user()->can('roles.destroy'),403);
        $role->delete();
        message_set('Role is deleted','success',3);

        return redirect()->route('roles.index')
            ->with('success','Role deleted successfully');
    }
}

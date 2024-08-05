<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('roles.index'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $roles = Role::with('permissions')->get();

        return view('pages.users-management.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('roles.create'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $permissions = Permission::all()->pluck('name', 'id');

        return view('pages.users-management.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->validated());
        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Success ! Data Roles Berhasil di Tambahkan');


        /**
         * Display the specified resource.
         *
         * @param  \App\Models\Role  $permission
         * @return \Illuminate\Http\Response
         */
    }
    public function show(Role $role)
    {
        abort_if(Gate::denies('roles.show'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('pages.users-management.roles.show', compact('role'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        abort_if(Gate::denies('roles.edit'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $permissions = Permission::all()->pluck('name', 'id');

        return view('pages.users-management.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Success ! Data Roles Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        abort_if(Gate::denies('roles.delete'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $role->delete();
        return redirect()->back()->with('success', 'Success ! Data Roles Berhasil di Hapus');
    }
}
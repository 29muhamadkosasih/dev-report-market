<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('users.index'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $users = User::with('role')->get();
        return view('pages.users-management.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('users.create'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $roles = Role::where('id', '!=', 1)->pluck('title', 'id');
        return view('pages.users-management.users.create', [
            'roles'   => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role_id'    => $request->role_id,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('users.index')->with('success', 'Success ! Data Users Berhasil di Tambahkan');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $permission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(Gate::denies('users.show'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $data = User::find($id);
        return view('pages.users-management.users.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('users.edit'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $user = User::find($id);
        $roles = Role::pluck('title', 'id');
        return view('pages.users-management.users.edit', compact(
            'user',
            'roles'

        ));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input  = $request->all();
        $user = User::find($id);
        $user->update($input);
        return redirect()->route('users.index')->with('success', 'Success ! Data Users Berhasil di Update');


        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('users.delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $user->delete();
        return redirect()->back()->with('success', 'Success ! Data Users Berhasil di Hapus');
    }
}
<?php

namespace App\Http\Controllers;

use App\Model\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        if( Auth::check() ){
            $role=[];
            $roles=Role::all();
            return view('role.index', ['roles'=>$roles, 'role'=>$role]);
        }
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $role = Role::create([
                'name' => $request->input('name'),
            ]);
            if($role){
                return redirect()->route('role.index', ['role'=> $role->id])
                ->with('success' , 'Role created successfully');
            }
        }
        return view('auth.login');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        if( Auth::check() ){
            $roles=Role::all();
            $role=Role::find($role->id);
            return view('role.index', ['roles'=>$roles, 'role'=>$role]);
        }
        return view('auth.login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        if( Auth::check() ){
            $roleUpdate=Role::where('id', $role->id)->update([
                'name'=>$request->input('name'),
            ]);
            if($roleUpdate){
            // return redirect('role.index',['role']=>$role->id)
                return redirect()->route('role.index', ['role'=>$role->id])
                ->with('success' , "Role Updated successfully");
            }
        }
        return view('auth.login');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}

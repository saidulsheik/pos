<?php

namespace App\Http\Controllers;

use App\Model\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if( Auth::check() ){
            $user=[];
            $users = User::all();
            $roles = Role::all();
            return view('user.index', [
                'users'=>$users, 
                'user'=>$user, 
                'roles'=>$roles,
                ]);
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
            $this->validate($request, array(
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'role_id' => ['required'],
                'password' => ['required', 'string', 'min:5', 'confirmed'],
            ));
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'role_id' => $request->input('role_id'),
                'password' => Hash::make($request->input('password')),
            ]);
            if($user){
                return redirect()->route('user.index', ['user'=> $user->id])
                ->with('success' , 'User created successfully');
            }
        }
        
        return back()->withInput()->with('errors', 'Error creating new company');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if( Auth::check() ){
            $roles = Role::all();
            $users  = User::all();
            $user   = User::find($user->id);
            return view('user.index',  ['user'=>$user, 'users'=>$users, 'roles'=>$roles]);
        }
        return view('auth.login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if( Auth::check() ){
            $userUpdate=User::where('id', $user->id)->update([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'role_id'=>$request->input('role_id'),
            ]);
            
            if($userUpdate){
                return redirect()->route('user.index', ['user'=>$user->id])
                ->with('success' , "User Updated successfully");
            }
        }
        return view('auth.login');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

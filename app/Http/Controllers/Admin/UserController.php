<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }
    public function create(){
        return view('admin.users.create');
    }

    public function store(Request $request){
        $validated_data = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $validated_data['password'] = Hash::make($validated_data['password']);
        User::create($validated_data);
        return redirect()->route('users.list')->with(['message'=>'user added successfully']);

    }

    public function edit($id){
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id){
        $validated_data = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'unique:users'],
            
        ]);

        $user = User::find($id);
        $user->name = $validated_data['name'];
        $user->phone = $validated_data['phone'];
        $user->save();
        return redirect()->route('users.list')->with(['message'=>'user updated successfully']);

    }

    public function delete($id){

        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.list')->with(['message'=>'user deleted successfully']);



    }

}










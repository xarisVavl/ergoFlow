<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
public function index() {
    return view('users.index',['users' =>User::all()]);
    }

    public function create() {
    return view('users.create');
    }

    public function store(Request $request) {
    $validated = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
        
    ]);
    $validated['password'] = Hash::make($validated['password']);
    User::create($validated);

        return redirect(route('users.index'));
}

public function edit(User $user) {
//    return view(route('users',['user'=>$user]));
return view('users.edit',['user'=>$user]);
    
}

public function update(User $user) {
//    return view(route('users',['user'=>$user]));
     $validated = request()->validate([
        'name' => 'required',
        'email' => "required|email|unique:users,email,{$user->id}",

        
    ]);
    $user->update($validated);
    return redirect(route('users.index')); 

}
public function show(User $user) {
    return view('users.show',[
        'user'=> $user,
        'leaveRequests'=>$user->leaveRequests->where('status', 'approved'),

    ]);
}
}



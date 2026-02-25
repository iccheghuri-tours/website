<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Str;

class UserController extends Controller
{
    //
    public function index(){
         $users = User::orderBy('created_at','desc')->get();
        return Inertia::render('admin/Users',[
            'data' => $users
        ]);
    }

    public function show(User $user){
        return Inertia::render('admin/details/User',[
            'data' => $user,
            'mode' => 'edit'
        ]);
    }

    public function create(){
        return Inertia::render("admin/details/User",[
            'mode'=>'create'
        ]);
    }
    
    public function update(Request $request, User $user){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255',
            'points' => 'required|integer',
            'completed_tours' => 'required|integer',
            'phone' => 'required|string|size:11',
            'role' => 'required|string|in:admin,user',
        ]);
        $user->update($validated);

        return redirect()->route('admin.users.index')
        ->with('message', 'User Updated successfully');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'points' => 'required|integer',
            'completed_tours' => 'required|integer',
            'phone' => 'required|string|size:11',
            'role' => 'required|string|in:admin,user',
        ]);
        $validated['email_verified_at'] = now();
        $validated['slug'] = Str::random(9);
        $validated['password'] = Hash::make(Str::random(9));
        User::create($validated);

        return redirect()->route('admin.users.index')
        ->with('message', 'User created successfully');
    }
    public function destroy(User $user){
        $user->delete();
        return redirect()->route('admin.users.index')
        ->with('message', 'User deleted successfully');
    }
}

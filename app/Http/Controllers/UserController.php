<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
            'data' => $user
        ]);
    }
    
    public function update(Request $request, User $user){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255',
            'points' => 'required|integer',
            'completed_tours' => 'required|integer',
            'phone' => 'required|string|size:11',
        ]);
        $user->update($validated);

        return redirect()->route('admin.users.index')
        ->with('message', 'User Updated successfully');
    }
    public function destroy(User $user){
        $user->delete();
        return redirect()->route('admin.users.index')
        ->with('message', 'User deleted successfully');
    }
}

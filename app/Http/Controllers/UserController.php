<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(){
        $users = User::all();
        return response()->json(['status'=>'success', 'users'=>$users]);
    }

    public function show(User $user){
        return response()->json(['status'=>'success', 'user'=>$user]);
    }
    
    public function update(Request $request, User $user){
        $request->validate([
            'points' => 'sometimes|integer',
            'completed_tours' => 'sometimes|integer',
            'role' => 'sometimes|string|in:user,admin',
            'phone' => 'sometimes|string|size:11',
        ]);
        $user->update($request->only(array_keys($request->all())));

        return response()->json(['status'=>'success', 'user'=>$user]);
    }
    public function destroy(User $user){
        $user->delete();
        return response()->json(['status'=>'success']);
    }
}

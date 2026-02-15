<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoyaltiController extends Controller
{
    //
    function index($slug){
        $user = User::where('slug', $slug)->firstOrFail();
        return Inertia::render('Loyalty', [
            'user' => $user
        ]);
    
    }
}
    
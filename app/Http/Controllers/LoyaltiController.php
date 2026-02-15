<?php

namespace App\Http\Controllers;

use App\Models\PointDeal;
use App\Models\User;
use App\Models\RegularDeal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoyaltiController extends Controller
{
    //
    function index($slug){
        $user = User::where('slug', $slug)->firstOrFail();
        $regularDeals = RegularDeal::all();
        $pointDeals = PointDeal::all();
        return Inertia::render('Loyalty', [
            'user' => $user,
            'regularDeals' => $regularDeals,
            'pointDeals' => $pointDeals
        ]);
    
    }
}
    
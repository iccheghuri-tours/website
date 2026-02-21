<?php

namespace App\Http\Controllers;

use App\Models\PointDeal;
use App\Models\RegularDeal;
use App\Models\User;
use Inertia\Inertia;

class AdminController extends Controller
{
    //
    function index(){
        return Inertia::render('admin/Dashboard',[
            'userCount'=>User::count(),
            'offerCount'=>PointDeal::count(),
            'partnerCount'=>RegularDeal::count()
        ]);
    }
    function mail(){
        return Inertia::render('admin/Mail');
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CRUDController extends Controller
{
    //
    function index(Request $request)
    {
        return Inertia::render('Admin');
    }
}

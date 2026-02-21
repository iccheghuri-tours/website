<?php

namespace App\Http\Controllers;

use App\Mail\SimpleMail;
use App\Models\PointDeal;
use App\Models\RegularDeal;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Mail;

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

    function sendMail(Request $request){
        $request->validate([
        'subject' => 'required|string|max:255',
        'body' => 'required|string',
    ]);

    $emails = User::pluck('email')->toArray();

    foreach($emails as $email){
        Mail::to($email)->send(new SimpleMail([
            'subject' => $request->subject,
            'message'=>$request->body
        ]));
    }

        return back()->with('success', 'Mail sent to all users!');


    }


    
}

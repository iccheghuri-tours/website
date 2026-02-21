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

function sendMail(Request $request)
{
    $request->validate([
        'subject'   => 'required|string|max:255',
        'body'      => 'required|string',
        'image'     => 'nullable|url',
        'btn_label' => 'nullable|string',
        'btn_link'  => 'nullable|url',
        'email'     => 'nullable|email',
    ]);

    // Determine recipients
    $recipients = $request->email ? [$request->email] : User::pluck('email')->toArray();

    // Send mail to each recipient
    foreach ($recipients as $email) {
        Mail::to($email)->send(new SimpleMail([
            'subject'   => $request->subject,
            'message'   => $request->body,
            'image'     => $request->image,
            'btn_label' => $request->btn_label,
            'btn_link'  => $request->btn_link,
        ]));
    }

    $successMessage = $request->email
        ? 'Mail sent to '.$request->email.'!'
        : 'Mail sent to all users!';

    return back()->with('success', $successMessage);
}


    
}

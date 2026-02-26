<?php

namespace App\Http\Controllers;

use App\Mail\SimpleMail;
use App\Models\CustomRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Mail;

class CustomRequestController extends Controller
{

    public function index()
    {
        $requests = CustomRequest::with('user')
        ->orderByRaw("FIELD(status, 'pending', 'rejected', 'solved')")
        ->orderBy('created_at', 'desc')
        ->get();
        return Inertia::render('admin/Requests',[
            'data' => $requests
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'request'=>'required|string',
        ]);
        $validated['user_id'] = auth()->id();
        CustomRequest::create($validated);
        return back()->with('message', 'Changes saved successfully');

    }

    
    public function show(CustomRequest $customRequest)
    {
        $customRequest->load('user');
        return Inertia::render('admin/details/Request',[
            'data' => $customRequest
            ]);
        
    }


    public function update(Request $request, CustomRequest $customRequest)
    {
    $validated = $request->validate([
        'status' => 'required|in:solved,rejected,pending',
        'note' => 'required|string',
    ]);

    $customRequest->update($validated);
    
    $statusMessages = [
        'solved' => 'Your request has been successfully resolved.',
        'pending' => 'Your request has been reopened.',
        'rejected' => 'Your request has been rejected.'
    ];

    $statusColors = [
        'solved' => '#28a745',   
        'pending' => '#007bff',  
        'rejected' => '#dc3545'  
    ];

    $subject = $statusMessages[$validated['status']];
    $message = $validated['note'];
    

    Mail::to($customRequest->user->email)->send(new SimpleMail([
        'subject' => $subject,
        'message' => $message,
        'btn_color' => $statusColors[$validated['status']],
    ]));    

    return back()->with('message', 'Changes saved successfully');

    }


}

<?php

namespace App\Listeners;

use App\Mail\SimpleMail;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendMailAfterNewLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        //
        $user = $event->user;
        $ipAddress = request()->ip();
        if ($user->hasVerifiedEmail()){
            Mail::to($user->email)->send(new SimpleMail([
            'subject' => 'New Login Detected',
            'message' => 'A new login to your account was detected from IP address: ' . $ipAddress . '. If this was not you, please secure your account immediately.',
        ]));
        }
        
    }
}

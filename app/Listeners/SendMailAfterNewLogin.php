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
        $ipData = json_decode(file_get_contents("http://ip-api.com/json/{$ipAddress}"));
        $location = $ipData && $ipData->status === 'success'
            ? "{$ipData->city}, {$ipData->regionName}, {$ipData->country}"
            : "Unknown Location";
        $browser = request()->header('User-Agent');
        $loginTime = now()->toDayDateTimeString();
        

        if ($user->hasVerifiedEmail() && $ipAddress != $user->last_ip && $ipAddress != $user->primary_ip) {
                $message = "Hello {$user->name},\n\n" .
                        "We detected a new login to your account with the following details:\n\n" .
                        "IP Address: {$ipAddress}\n" .
                        "Location: {$location}\n" .
                        "Browser: {$browser}\n" .
                        "Time: {$loginTime}\n\n" .
                        "If this was you, no action is needed.\n" .
                        "If you do NOT recognize this login, please secure your account immediately by resetting your password or logging out of all devices.\n\n" .
                        "Stay safe,\nIccheghuri Team";

                Mail::to($user->email)->send(new SimpleMail([
                    'subject' => 'New Login Detected',
                    'message' => $message,
                ]));
        }



        $user->last_ip = $ipAddress;
        $user->save();
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Str;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return Inertia::render('admin/Users', [
            'data' => $users
        ]);
    }

    public function show(User $user)
    {
        return Inertia::render('admin/details/User', [
            'data' => $user,
            'mode' => 'edit'
        ]);
    }

    public function create()
    {
        return Inertia::render("admin/details/User", [
            'mode' => 'create'
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'points' => 'required|integer',
            'completed_tours' => 'required|integer',
            'phone' => 'required|string|size:11|unique:users,phone,' . $user->id,
            'role' => 'required|string|in:admin,user',
            'email_verified' => 'required|boolean',
        ]);

        if ($validated['email_verified']) {
            if ($user->email_verified_at === null) {
                $validated['email_verified_at'] = now();
            }
        } else {
            $validated['email_verified_at'] = null;
        }

        unset($validated['email_verified']);

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('message', 'User Updated successfully');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'points' => 'required|integer',
            'completed_tours' => 'required|integer',
            'phone' => 'required|string|size:11|unique:users,phone',
            'role' => 'required|string|in:admin,user',
        ]);
        $validated['email_verified_at'] = now();
        $validated['slug'] = Str::random(9);
        $validated['password'] = Hash::make(Str::random(9));
        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('message', 'User created successfully');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('message', 'User deleted successfully');
    }
    public function verifyEmail(Request $request)
    {
        $validated = $request->validate([
            'otp' => 'required|digits:4',
        ]);

        $user = $request->user();

        // Check expiry first
        if (!$user->otp_expires_at || $user->otp_expires_at->isPast()) {
            return back()->withErrors(['otp' => 'OTP has expired']);
        }

        // Check OTP match
        if ($user->otp !== $validated['otp']) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        // Success
        $user->markEmailAsVerified();
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return redirect()->route('dashboard')
            ->with('message', 'Email verified successfully');
    }


    public function resendOtp(Request $request){
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        $user->otp = random_int(1000, 9999);
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        $user->sendEmailVerificationNotification();

        return back()->with('status', 'A new verification code has been sent!');

    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\User;
use Mail;
use Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // use SendsPasswordResetEmails;
    public function showForgetPasswordForm()
    {
       return view('auth.passwords.reset');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        Mail::send('auth.passwords.mail-template', ['token' => $token,'email' => $request->email,], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Your StyleBrix Account Password ');
        });
        return back()->with('success', 'We have e-mailed your password reset link!');
    }

    public function showResetPasswordForm(Request $request,$token) {
        $token = $request->route()->parameter('token');
        return view('auth.passwords.reset_password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function submitResetPasswordForm(Request $request)
    {
        $updatePassword = DB::table('password_resets')
        ->where([
          'email' => $request->email])->latest()->first();
        if(!$updatePassword){
        return back()->withInput()->with('error', 'Invalid token!');
        }
        $check_password = User::where('email',$request->email)->first();
        if (Hash::check($request->password, $check_password->password)) {
        // The old and new passwords are the same
        // Return a response indicating that the new password must be different
            return back()->with('error', 'The new password must be different.');
        }
        $user = User::where('email', $request->email)
        ->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where(['email'=> $request->email])->delete();
        return redirect()->route('login')->with('success', 'Your password has been changed!');
    }
}

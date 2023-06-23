<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Jobs\SendPasswordResetEmail;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function loadRegister()
    {
        return view('auth/register');
    }

    public function register(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|max:100',
                'mobile' => 'required|max:15',
                'email' => 'required|email|unique:users',
            ],
            [
                'name.required' => 'Name is required',
                'name.max' => 'Name must not be greater than 100 characters',
                'mobile.required' => 'Mobile number is required',
                'mobile.max' => 'Mobile number must not be greater than 15 characters',
                'email.required' => 'Email id is required',
                'email.email' => 'Enter valid email id',
                'email.unique' => 'Email id already exist',
            ]
        );

        $password = Str::random(10);
        $data['password'] = bcrypt($password);

        $user = User::create($data);
        $emailData = [
            'subject' => 'Hey - Welcome to Let\'s Calendar',
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password,
        ];
        SendEmailJob::dispatch($emailData);

        return redirect('verify-account');
    }

    public function forgotPassword()
    {
        return view('auth/forgot-password');
    }

    public function resetPasswordRequest(Request $request)
    {

        $data = $request->validate([
            'email' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        dispatch(new SendPasswordResetEmail($user));


        return view('auth/verify-email');
    }

    public function verifyAccount()
    {
        return view('auth/verify-email');
    }

    public function resetPassword($email)
    {
        $user = User::where('email', base64_decode($email))->first();
        $user->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
        $user->save();

        return view('auth/reset-password')->with('email', $email);
    }

    public function passwordUpdate(Request $request)
    {
        $email = base64_decode($request->email);

        $password = bcrypt($request->password);

        $user = User::where('email', $email)->first();
        $user->password = $password;
        $user->save();

        return redirect('login');
    }

    public function loadLogin()
    {
        return view('auth/login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($data)) {
            return back()->with('error', 'Incorrect Details. Please try again');
        }
        return redirect('campaigns');

    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();

        return redirect('/login');
    }
}
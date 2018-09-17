<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Mail\VerifyMail;
use App\User;
use Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    //
    public function register(UserRequest $request){
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'verify_code' => Str::random(),
            'status' => User::STATUS_WAIT,
            ]);

//        \Mail::to($user->email)->send(new VerifyMail($user));
        \Mail::to(env('MAIL_BOX'))->send(new VerifyMail($user));
        event(new Registered($user));
//        Auth::login($user);
        return redirect()->route('home');


    }

    public function showForm(){
        return view('auth.register');
    }

    /**
     * Ссылка
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify($token){
        if (!$user = User::where('verify_code', $token)->first()){
            return redirect()->route('login')
                ->with('error', 'Sorry your link is bad');
        }
        if ($user->status !== User::STATUS_WAIT){
            return redirect()->route('login')->with('error', 'Your email already verified');
        }
        $user->status = User::STATUS_ACTIVE;
        $user->verify_code = null;
        $user->save();

        return redirect()->route('login')
            ->with('success', 'Your e-mail is verified. You can now login');

    }
}

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
        $user = User::register(
            $request['name'],
            $request['email'],
            $request['password'
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

        try {
            $user->verify();
        } catch (\DomainException $e) {
            return redirect()->route('login')->with('error', $e->getMessage());
        }


        return redirect()->route('login')->with('status', 'Your email is verified. You can now login.');

//        Перенесли в пользователя
//        $user->status = User::STATUS_ACTIVE;
//        $user->verify_code = null;
//        $user->save();

        return redirect()->route('login')
            ->with('success', 'Your e-mail is verified. You can now login');

    }
}

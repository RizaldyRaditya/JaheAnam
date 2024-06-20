<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
class RegisterController extends Controller
{
    function index(){
        return view('register');
    }

    public function store(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            session()->flash('modal_message', 'Email sudah digunakan');
            return redirect('register');
        } else {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'tipe' => 'normal'
            ]);

            event(new Registered($user));

            Auth::login($user);
            session()->flash('modal_message', 'Berhasil terdaftar!');
            return redirect('/email/verify');
        }
    }

    public function handlergoogle(){
        $user = Socialite::driver('google')->user();
        $finduser = User::where('email', $user->getEmail())->first();
        if($finduser){
            Auth::login($finduser);
            return redirect()->intended('/');
        } else {
            $newuser = User::create([
                'email' => $user->getEmail(),
                'password' => Hash::make('akusukakoding'),
                'role' => 'user',
                'tipe' => 'google'
            ]);

            event(new Registered($newuser));

            Auth::login($newuser);
            session()->flash('modal_message', 'Berhasil terdaftar!');
            return redirect('/email/verify');
        }
    }

    public function emailverify()
    {
        return view('auth.verify-email');
    }

    public function verifverify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/');
    }
}

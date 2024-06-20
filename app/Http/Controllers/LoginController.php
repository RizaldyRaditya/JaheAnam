<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;
class LoginController extends Controller
{
    function index(){
        return view('login');
    }

     public function authenticate(Request $request): RedirectResponse
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();
        if ($user->role == 'admin') {
            return redirect('dashboard');
        } else {
            return redirect()->intended('/');
        }
    }

    return back()->with('loginError', 'Login Failed');
}


    public function logout(Request $request): RedirectResponse
    {
        $user = Auth::user();
        if($user->role == 'admin'){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        } else {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }
    }

    public function redirectgoogle(){
        if (!Auth::check()) {
            return Socialite::driver('google')->redirect();
        } else {
            return redirect()->intended('home');
        }
    }

     public function forgotpassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->where('tipe', 'normal')->first();
        if (!$user) {
            session()->flash('modal_message', 'Email salah atau tidak terdaftar!');
        }

        $status = Password::sendResetLink($request->only('email'));
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('modal_message', 'Link reset sudah dikirim ke email!');
        } else {
            return back()->with('modal_message', 'Email salah atau tidak terdaftar!');
        }


    }


    public function restpwtkn(string $token)
    {
        return view('auth.resetpassword', ['token' => $token]);
    }

    public function restpw(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}

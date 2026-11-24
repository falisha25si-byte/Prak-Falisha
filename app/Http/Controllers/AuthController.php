<?php
namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Data tambahan ini terpisah dari status autentikasi
            session(['last_login' => now()]);

            return redirect()->intended(route('dashboard'))
                ->with('success', 'Login berhasil!');
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah'])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        //Development Only
        $googleUser = Socialite::driver('google')
            ->setHttpClient(new Client(['verify' => false]))
            ->stateless()
            ->user();
        $email_user = $googleUser->email;

        //cari user berdasarkan email
        $user = User::where('email', $email_user)->first();

        //jika ada login kan dan redirect ke dashboard
        if ($user) {
            Auth::login($user);
            request()->session()->regenerate();
            session(['last_login' => now()]);

            return redirect()->route('dashboard')
                ->with('success', 'Login berhasil!');
        }

        //jika tidak ada kirim error ke halaman login
        return redirect()->route('auth.login')
            ->withErrors(['email' => 'Email tidak terdaftar!']);
    }
}

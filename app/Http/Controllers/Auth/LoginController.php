<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserLoggedIn;
use App\Http\Controllers\Controller;
use App\Mail\LoginOtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        $bannerUrl = file_exists(public_path('Image/banner.jpg'))
            ? asset('Image/banner.jpg')
            : asset('image/banner.jpg');

        $logoUrl = file_exists(public_path('Image/logo.png'))
            ? asset('Image/logo.png')
            : asset('image/logo.png');

        return view('auth.login', compact('bannerUrl', 'logoUrl'));
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->onlyInput('email');
        }

        $otp = $user->isAdmin()
            ? '123456'
            : str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        Cache::put('login_otp_'.$user->email, $otp, now()->addMinutes(10));

        if (! $user->isAdmin()) {
            Mail::to($user->email)->send(new LoginOtpMail($user, $otp));
        }

        $request->session()->flash(
            'status',
            $user->isAdmin()
                ? 'Enter OTP 123456 to continue.'
                : 'We sent a one-time code to your email.'
        );
        $request->session()->put('login_email', $user->email);

        return redirect()->route('login.otp');
    }

    public function showOtpForm(Request $request)
    {
        $bannerUrl = file_exists(public_path('Image/banner.jpg'))
            ? asset('Image/banner.jpg')
            : asset('image/banner.jpg');

        $logoUrl = file_exists(public_path('Image/logo.png'))
            ? asset('Image/logo.png')
            : asset('image/logo.png');

        return view('auth.otp', compact('bannerUrl', 'logoUrl'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()->withErrors(['email' => 'No account found with that email address.'])->withInput();
        }

        $cachedOtp = Cache::get('login_otp_'.$request->email);
        $isValidOtp = $cachedOtp === $request->otp
            || ($user->isAdmin() && $request->otp === '123456');

        if (! $isValidOtp) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.'])->withInput();
        }

        Cache::forget('login_otp_'.$request->email);
        $request->session()->forget('login_email');

        Auth::login($user);
        $request->session()->regenerate();

        event(new UserLoggedIn($user));

        if (! $user->isAdmin() && $this->isAdminOnlyUrl($request->session()->get('url.intended'))) {
            $request->session()->forget('url.intended');
        }

        return redirect()->intended(route('admin.dashboard'));
    }

    private function isAdminOnlyUrl(?string $url): bool
    {
        if (! $url) {
            return false;
        }

        return str_contains($url, '/admin/staff');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
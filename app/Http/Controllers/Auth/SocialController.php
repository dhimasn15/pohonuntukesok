<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;

class SocialController extends Controller
{
    // Redirect to provider (google)
    public function redirect($provider)
    {
        // only allow google for now
        if ($provider !== 'google') {
            abort(404);
        }
        return Socialite::driver($provider)->redirect();
    }

    // Handle callback from provider
    public function callback($provider)
    {
        if ($provider !== 'google') {
            abort(404);
        }

        try {
            // use stateless() if you don't use sessions for testing; remove stateless() if using web session
            $socialUser = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            return redirect()->route('home')->with('error', 'Gagal autentikasi dengan Google.');
        }

        if (!$socialUser || ! $socialUser->getEmail()) {
            return redirect()->route('home')->with('error', 'Email tidak tersedia dari Google.');
        }

        // cari user berdasarkan google_id atau email
        $user = User::where('google_id', $socialUser->getId())
                    ->orWhere('email', $socialUser->getEmail())
                    ->first();

        if (!$user) {
            // buat user baru (sesuaikan fields kalau diperlukan)
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'User',
                'email' => $socialUser->getEmail(),
                'google_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
                'password' => bcrypt(Str::random(16)),
                'role' => 'user',
                'is_active' => 1,
            ]);
        } else {
            // update google_id / avatar jika belum ada
            $updated = [];
            if (!$user->google_id) $updated['google_id'] = $socialUser->getId();
            if ($socialUser->getAvatar() && $user->avatar !== $socialUser->getAvatar()) $updated['avatar'] = $socialUser->getAvatar();
            if (!empty($updated)) $user->update($updated);
        }

        Auth::login($user, true);

        return redirect()->intended('/')->with('success', 'Berhasil masuk dengan Google.');
    }
}

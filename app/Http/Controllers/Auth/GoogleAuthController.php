<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            Log::info('Google User Data:', [
                'id' => $googleUser->getId(),
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar(),
            ]);

            // Cek apakah user sudah ada berdasarkan email
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                Log::info('Creating new user...');
                
                // Buat user baru dengan avatar dari Google
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(), // Simpan avatar dari Google
                    'password' => Hash::make(Str::random(24)),
                ]);

                Log::info('New user created:', [
                    'user_id' => $user->id, 
                    'avatar' => $user->avatar,
                    'name' => $user->name
                ]);
            } else {
                Log::info('User found, updating Google data...', [
                    'user_id' => $user->id,
                    'current_avatar' => $user->avatar
                ]);
                
                // Update user dengan data Google terbaru
                $updateData = [
                    'google_id' => $googleUser->getId(),
                    'name' => $googleUser->getName(),
                ];
                
                // Update avatar hanya jika dari Google dan belum ada
                if ($googleUser->getAvatar() && empty($user->avatar)) {
                    $updateData['avatar'] = $googleUser->getAvatar();
                }
                
                $user->update($updateData);
                
                Log::info('User updated successfully', [
                    'new_avatar' => $user->avatar,
                    'avatar_updated' => isset($updateData['avatar'])
                ]);
            }
            
            // Login user
            Auth::login($user);
            
            Log::info('User logged in successfully', [
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar
            ]);

            // Redirect admin to dashboard, others to home
            if ($user->role === 'admin') {
                return '/admin/dashboard';
            }

            return redirect('/')->with('success', 'Login berhasil! Selamat datang ' . $user->name . '!');
            
        } catch (\Exception $e) {
            Log::error('Google Auth Error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect('/')
                ->with('error', 'Login dengan Google gagal: ' . $e->getMessage());
        }
    }

    // Method untuk handle login manual
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirect admin to dashboard, others to home
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil! Selamat datang Admin ' . Auth::user()->name . '!');
            }
            
            return redirect('/')->with('success', 'Login berhasil! Selamat datang ' . Auth::user()->name . '!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    // Method untuk handle registrasi manual
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Generate avatar dari UI Avatars
        $avatarUrl = 'https://ui-avatars.com/api/?name=' . urlencode($request->name) . 
                    '&background=2D4F2B&color=ffffff&size=128&bold=true';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $avatarUrl, // Simpan avatar generated
        ]);

        Log::info('Manual registration:', [
            'user_id' => $user->id,
            'name' => $user->name,
            'avatar' => $user->avatar
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Registrasi berhasil! Selamat datang ' . $user->name . '!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Logout berhasil! Sampai jumpa lagi.');
    }

    // Method untuk show login form (untuk form biasa)
    public function showLoginForm()
    {
        // Redirect ke home dan buka modal login
        return redirect('/')->with('open_modal', 'login');
    }

    // Method untuk show registration form (untuk form biasa)
    public function showRegistrationForm()
    {
        // Redirect ke home dan buka modal register
        return redirect('/')->with('open_modal', 'register');
    }
}
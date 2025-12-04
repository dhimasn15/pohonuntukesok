<?php
// app/Http/Controllers/VolunteerController.php
namespace App\Http\Controllers;

use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VolunteerController extends Controller
{
    public function create()
    {
        $existing = Volunteer::where('user_id', Auth::id())->first();
        if ($existing) {
            if ($existing->isApproved()) {
                return redirect()->route('home')->with('info', 'Anda sudah terdaftar sebagai relawan.');
            } elseif ($existing->isPending()) {
                return redirect()->route('home')->with('info', 'Pendaftaran relawan Anda sedang menunggu persetujuan.');
            }
        }

        return view('relawan.daftar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:15',
            'alamat_lengkap' => 'nullable|string',
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_diri' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'pengalaman_relawan' => 'nullable|string|min:20',
        ]);

        try {
            $fotoKtpPath = $request->hasFile('foto_ktp') ? $request->file('foto_ktp')->store('volunteer-ktp', 'public') : null;
            $fotoDiriPath = $request->hasFile('foto_diri') ? $request->file('foto_diri')->store('volunteer-diri', 'public') : null;

            Volunteer::create([
                'user_id' => Auth::id(),
                'nama_lengkap' => $request->nama_lengkap,
                'no_telepon' => $request->no_telepon,
                'alamat_lengkap' => $request->alamat_lengkap,
                'kecamatan' => $request->kecamatan,
                'kabupaten' => $request->kabupaten,
                'provinsi' => $request->provinsi,
                'foto_ktp' => $fotoKtpPath,
                'foto_diri' => $fotoDiriPath,
                'pengalaman_relawan' => $request->pengalaman_relawan,
                'status' => 'pending',
            ]);

            return redirect()->route('home')->with('success', 'Pendaftaran relawan berhasil! Menunggu persetujuan admin.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

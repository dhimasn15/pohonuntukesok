<?php
// app/Http/Controllers/FarmerController.php
namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\FarmerPlant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FarmerController extends Controller
{
    // Form pendaftaran petani
    public function create()
    {
        // Cek apakah user sudah mendaftar sebagai petani
        $existingFarmer = Farmer::where('user_id', Auth::id())->first();
        
        if ($existingFarmer) {
            if ($existingFarmer->isApproved()) {
                return redirect()->route('petani.dashboard')->with('info', 'Anda sudah terdaftar sebagai petani.');
            } elseif ($existingFarmer->isPending()) {
                return redirect()->route('petani.dashboard')->with('info', 'Pendaftaran Anda sedang menunggu persetujuan.');
            }
        }

        return view('petani.daftar');
    }

    // Simpan pendaftaran petani
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|digits:16|unique:farmers,nik',
            'no_telepon' => 'required|string|max:15',
            'alamat_lengkap' => 'required|string',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_diri' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'pengalaman_bertani' => 'required|string|min:50',
            'jenis_tanaman_dikuasai' => 'required|string|min:10',
        ]);

        try {
            // Upload foto KTP
            $fotoKtpPath = $request->file('foto_ktp')->store('farmer-ktp', 'public');
            
            // Upload foto diri
            $fotoDiriPath = $request->file('foto_diri')->store('farmer-diri', 'public');

            // Simpan data petani
            $farmer = Farmer::create([
                'user_id' => Auth::id(),
                'nama_lengkap' => $request->nama_lengkap,
                'nik' => $request->nik,
                'no_telepon' => $request->no_telepon,
                'alamat_lengkap' => $request->alamat_lengkap,
                'kecamatan' => $request->kecamatan,
                'kabupaten' => $request->kabupaten,
                'provinsi' => $request->provinsi,
                'foto_ktp' => $fotoKtpPath,
                'foto_diri' => $fotoDiriPath,
                'pengalaman_bertani' => $request->pengalaman_bertani,
                'jenis_tanaman_dikuasai' => $request->jenis_tanaman_dikuasai,
                'status' => 'pending',
            ]);

            return redirect()->route('petani.dashboard')->with('success', 'Pendaftaran berhasil! Menunggu persetujuan admin.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Dashboard petani
    public function dashboard()
    {
        $farmer = Farmer::where('user_id', Auth::id())->firstOrFail();
        $plants = $farmer->plants()->latest()->get();
        
        return view('petani.dashboard', compact('farmer', 'plants'));
    }

    // Kelola tanaman
    public function managePlants()
    {
        $farmer = Farmer::where('user_id', Auth::id())->firstOrFail();
        
        if (!$farmer->isApproved()) {
            return redirect()->route('petani.dashboard')->with('error', 'Akun petani Anda belum disetujui.');
        }

        $plants = $farmer->plants()->latest()->get();
        return view('petani.tanaman', compact('farmer', 'plants'));
    }

    // Simpan tanaman
    public function storePlant(Request $request)
    {
        $farmer = Farmer::where('user_id', Auth::id())->firstOrFail();

        if (!$farmer->isApproved()) {
            return response()->json(['error' => 'Akun petani belum disetujui'], 403);
        }

        $request->validate([
            'jenis_tanaman' => 'required|string|max:255',
            'stok' => 'required|integer|min:1',
            'harga_per_pohon' => 'required|numeric|min:1000',
            'deskripsi' => 'nullable|string',
            'foto_tanaman' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $fotoTanamanPath = null;
            if ($request->hasFile('foto_tanaman')) {
                $fotoTanamanPath = $request->file('foto_tanaman')->store('farmer-plants', 'public');
            }

            FarmerPlant::create([
                'farmer_id' => $farmer->id,
                'jenis_tanaman' => $request->jenis_tanaman,
                'stok' => $request->stok,
                'harga_per_pohon' => $request->harga_per_pohon,
                'deskripsi' => $request->deskripsi,
                'foto_tanaman' => $fotoTanamanPath,
                'status' => $request->stok > 0 ? 'tersedia' : 'habis',
            ]);

            return back()->with('success', 'Tanaman berhasil ditambahkan!');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Update tanaman
    public function updatePlant(Request $request, $id)
    {
        $plant = FarmerPlant::findOrFail($id);
        
        // Pastikan tanaman milik petani yang login
        if ($plant->farmer->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'jenis_tanaman' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga_per_pohon' => 'required|numeric|min:1000',
            'deskripsi' => 'nullable|string',
            'foto_tanaman' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            if ($request->hasFile('foto_tanaman')) {
                // Hapus foto lama jika ada
                if ($plant->foto_tanaman) {
                    Storage::disk('public')->delete($plant->foto_tanaman);
                }
                $plant->foto_tanaman = $request->file('foto_tanaman')->store('farmer-plants', 'public');
            }

            $plant->update([
                'jenis_tanaman' => $request->jenis_tanaman,
                'stok' => $request->stok,
                'harga_per_pohon' => $request->harga_per_pohon,
                'deskripsi' => $request->deskripsi,
                'status' => $request->stok > 0 ? 'tersedia' : 'habis',
            ]);

            return back()->with('success', 'Tanaman berhasil diperbarui!');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Hapus tanaman
    public function deletePlant($id)
    {
        $plant = FarmerPlant::findOrFail($id);
        
        // Pastikan tanaman milik petani yang login
        if ($plant->farmer->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {
            // Hapus foto jika ada
            if ($plant->foto_tanaman) {
                Storage::disk('public')->delete($plant->foto_tanaman);
            }

            $plant->delete();

            return back()->with('success', 'Tanaman berhasil dihapus!');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Admin: Daftar petani pending
    public function adminIndex()
    {
        $pendingFarmers = Farmer::where('status', 'pending')->with('user')->get();
        $approvedFarmers = Farmer::where('status', 'approved')->with('user')->get();
        
        return view('admin.petani', compact('pendingFarmers', 'approvedFarmers'));
    }

    // Admin: Setujui petani
    public function approve($id)
    {
        $farmer = Farmer::findOrFail($id);
        
        $farmer->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Petani berhasil disetujui!');
    }

    // Admin: Tolak petani
    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'required|string|min:10',
        ]);

        $farmer = Farmer::findOrFail($id);
        
        $farmer->update([
            'status' => 'rejected',
            'catatan_admin' => $request->catatan_admin,
        ]);

        return back()->with('success', 'Petani berhasil ditolak!');
    }
}
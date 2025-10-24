<?php
// app/Models/Farmer.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nik',
        'no_telepon',
        'alamat_lengkap',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'foto_ktp',
        'foto_diri',
        'pengalaman_bertani',
        'jenis_tanaman_dikuasai',
        'status',
        'catatan_admin',
        'approved_at'
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plants()
    {
        return $this->hasMany(FarmerPlant::class);
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }
}

// app/Models/FarmerPlant.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerPlant extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmer_id',
        'jenis_tanaman',
        'stok',
        'harga_per_pohon',
        'deskripsi',
        'foto_tanaman',
        'status'
    ];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }
}
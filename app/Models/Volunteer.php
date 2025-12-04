<?php
// app/Models/Volunteer.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'no_telepon',
        'alamat_lengkap',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'foto_ktp',
        'foto_diri',
        'pengalaman_relawan',
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

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }
}

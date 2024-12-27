<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins'; // Nama tabel

    // Kolom yang dapat diisi
    protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'no_hp',
        'jenis_gabah',
        'berat_gabah',
        'durasi_pengeringan',
        'status',
    ];

    /**
     * Validasi nilai 'status' saat diset.
     */
    public function setStatusAttribute($value)
    {
        $allowedStatuses = ['Menunggu', 'Proses', 'Selesai'];
        if (in_array($value, $allowedStatuses)) {
            $this->attributes['status'] = $value;
        } else {
            throw new \InvalidArgumentException("Status tidak valid: $value");
        }
    }

    /**
     * Format nilai 'status' saat diakses.
     */
    public function getStatusAttribute($value)
    {
        return ucfirst($value); // Kapitalisasi huruf pertama
    }

    /**
     * Hitung durasi pengeringan berdasarkan waktu tertentu (contoh fitur tambahan).
     */
    public function calculateRemainingTime($currentTime)
    {
        $remainingTime = $this->durasi_pengeringan - $currentTime;
        return $remainingTime > 0 ? $remainingTime : 0;
    }
}

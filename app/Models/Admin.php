<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins'; // Jika tabel Anda bernama 'admins'
    
    protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'no_hp',
        'jenis_gabah',
        'berat_gabah',
        'durasi_pengeringan',
        'status',
    ];
}

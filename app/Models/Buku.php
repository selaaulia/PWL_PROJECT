<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Buku as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'bukus';
    protected $primaryKey = 'id_buku';

    protected $fillable = [
        'kode_buku',
        'judul_buku',
        'kategori_buku',
        'nama_penulis',
        'nama_penerbit',
        'no_rak',
        'tahun',
        'jumlah',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}

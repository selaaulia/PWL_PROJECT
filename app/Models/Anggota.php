<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $primaryKey = 'Nim';

    protected $fillable = [
        'Nim',
        'Nama',
        'kelas',
        'Jurusan',
        'No_Hp',
        'Email',
        'Gambar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
    public static function getByUser($user_id)
    {
        return Anggota::where([
            'user_id' => $user_id
        ])->first();
    }

}

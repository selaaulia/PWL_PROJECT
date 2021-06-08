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

}

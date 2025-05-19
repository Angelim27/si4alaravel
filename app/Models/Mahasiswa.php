<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa'; // nama tabel

     protected $fillable = [
        'npm',
        'nama',
        'jk',
        'tanggal_lahir',
        'tempat_lahir',
        'asal_sma',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id'); 
    }  
}

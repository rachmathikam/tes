<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $guarded = [];

    public function tahun_pelajaran(){
        return $this->belongsTo(TahunPelajaran::class, 'tahun_pelajaran_id', 'id');
    }

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'kelas_siswas')->withPivot('kelas_id')->withTimestamps();
    }

}

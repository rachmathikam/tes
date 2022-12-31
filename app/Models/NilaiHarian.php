<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiHarian extends Model
{
    use HasFactory;
    protected $table = "nilai_harians";
    protected $with = ['kelas_siswa'];
    protected $guarded = [];

    public function nilai_pts()
    {
        return $this->belongsTo(NilaiPTS::class,'id');
    }

    public function nilai_pas()
    {
        return $this->belongsTo(NilaiPAS::class, 'id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapels_id','id');
    }

    public function kelas_siswa()
    {
        return $this->belongsTo(KelasSiswa::class,'kelas_siswa_id','id');
    }

}

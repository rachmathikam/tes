<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasSiswa extends Model
{
    use HasFactory;

    protected $table = 'kelas_siswas';
    // protected $with = ['tahun_pelajarans'];
    protected $guarded = [];



    /**
     * Get the user that owns the KelasSiswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nilai_harian()
    {
        return $this->belongsTo(NilaiHarian::class);
    }
// }

//      /**
//      * Get the user that owns the KelasSiswa
//      *
//      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
//      */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
}



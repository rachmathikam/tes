<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunPelajaran extends Model
{
    use HasFactory;
    protected $table = 'tahun_pelajarans';
    protected $with = ['kelas'];
    protected $guarded = [];


    public function kelas()
    {
        return $this->belongsTo(Kelas::class,'id');
    }
}

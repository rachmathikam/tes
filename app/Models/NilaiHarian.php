<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiHarian extends Model
{
    use HasFactory;
    protected $table ='nilai_harians';
    protected $guarded = [];

    public function nilai(){
        return $this->belongsTo(Nilai::class);
    }
    public function mapel(){
        return $this->belongsTo(Mapel::class, 'id');
    }

    public function siswa(){
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}

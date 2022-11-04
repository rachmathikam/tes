<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    public function nilaiHarian(){
        return $this->belongsTo(NilaiHarian::class,'nilai_harian_id');
    }
}

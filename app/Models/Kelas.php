<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $guarded = [];

    public function romawi(){
        return $this->belongsTo(Romawi::class);
    }

    public function CodeKelas(){
        return $this->belongsTo(CodeKelas::class,'code_id');
    }

    public function siswa(){
        return $this->belongsTo(Siswa::class,'id');
    }



}

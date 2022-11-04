<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeKelas extends Model
{
    use HasFactory;
    protected $table = 'code_kelas';
    protected $guarded = [];


    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
}

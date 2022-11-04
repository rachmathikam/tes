<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'gurus';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function mapel(){
        return $this->belongsTo(Mapel::class,'id');
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
}

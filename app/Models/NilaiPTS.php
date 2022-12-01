<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPTS extends Model
{
    use HasFactory;

    protected $table = 'nilai_p_t_s';
    protected $with = ['nilai_harian'];
    protected $guarded= [];

    public function nilai_harian()
    {
        return $this->belongsTo(NilaiHarian::class,'id');
    }

}

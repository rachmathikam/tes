<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPTS extends Model
{
    use HasFactory;

    protected $table = 'nilai_p_t_s';
    protected $guarded= [];

    public function nilai_harian()
    {
        return $this->belongsTo(NilaiHarian::class, 'nilai_harian_id', 'id');
    }

}

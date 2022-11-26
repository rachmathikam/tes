<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapels';
    protected $guarded = [];

    public function aspek()
    {
        return $this->belongsToMany(Aspek::class,'mapel_aspeks', 'mapel_id', 'aspek_id');
    }


}

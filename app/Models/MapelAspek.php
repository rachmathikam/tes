<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapelAspek extends Model
{
    use HasFactory;
    protected $table = 'mapel_aspeks';
    protected $guarded = [];



            /**
             * Get the user that owns the KelasSiswa
             *
             * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
             */
            public function mapel()
            {
                return $this->belongsTo(Mapel::class, 'mapel_id', 'id');
            }
            /**
             * Get the user that owns the KelasSiswa
             *
             * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
             */
            public function aspek()
            {
                return $this->belongsTo(Aspek::class, 'aspek_id', 'id');
            }
}

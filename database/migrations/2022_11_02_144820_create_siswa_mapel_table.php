<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_mapel', function (Blueprint $table) {
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('mapels_id');
            $table->foreign('siswa_id')->references('id')->on('siswas')
            ->onDelete('restrict');
            $table->foreign('mapels_id')->references('id')->on('mapels')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa_mapel');
    }
};

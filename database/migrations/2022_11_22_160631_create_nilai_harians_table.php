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
        Schema::create('nilai_harians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_siswa_id')->references('id')->on('kelas_siswas')->onDelete('cascade');
            $table->foreignId('mapels_id')->references('id')->on('mapels')->onDelete('cascade');
            $table->enum('aspek',['pengetahuan','keterampilan','bacaan','hafalan']);
            $table->string('nilai_n1');
            $table->string('nilai_n2');
            $table->string('nilai_n3');
            $table->string('nilai_n4');
            $table->string('nilai_rata2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_harians');
    }
};

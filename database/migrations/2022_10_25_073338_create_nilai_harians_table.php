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
            $table->foreignId('mapels_id')->references('id')->on('mapels')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('siswa_id')->references('id')->on('siswas')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nilai_harian')->nullable();
            $table->string('nilai_uts')->nullable();
            $table->string('nilai_uas')->nullable();
            $table->string('KKM')->nullable();
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

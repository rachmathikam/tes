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
        Schema::create('nilai_p_a_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nilai_harian_id')->references('id')->on('nilai_harians')->onDelete('cascade');
            $table->enum('semester',['Ganjil','Genap']);
            $table->string('nilai_uas');
            $table->string('pensan_guru')->nullable();
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
        Schema::dropIfExists('nilai_p_a_s');
    }
};

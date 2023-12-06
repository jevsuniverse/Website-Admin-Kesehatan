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
        Schema::create('resep_has_obat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_resep_obat');
            $table->unsignedBigInteger('id_obat');
            $table->timestamps();

            $table->foreign('id_resep_obat')->references('id')->on('resep_obat');
            $table->foreign('id_obat')->references('id')->on('obat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resep_has_obats');
    }
};

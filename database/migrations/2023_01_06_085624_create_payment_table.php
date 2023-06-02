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
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_resep_obat');
            $table->unsignedBigInteger('id_pasien');
            $table->date('tanggal_payment');
            $table->integer('total_harga');
            $table->timestamps();

            $table->foreign('id_resep_obat')->references('id')->on('resep_obat');
            $table->foreign('id_pasien')->references('id')->on('sesi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment');
    }
};

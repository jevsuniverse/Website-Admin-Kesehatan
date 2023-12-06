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
        Schema::create('sesi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_dokter");
            $table->unsignedBigInteger("id_pasien");
            $table->longText("deskripsi_hasil")->nullable();
            $table->date("tanggal_sesi");
            $table->string("status_sesi");
            $table->timestamps();

            $table->foreign("id_dokter")->references("id")->on("dokter");
            $table->foreign("id_pasien")->references("id")->on("pasien");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sesi');
    }
};

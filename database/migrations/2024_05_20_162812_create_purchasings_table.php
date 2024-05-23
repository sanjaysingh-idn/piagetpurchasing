<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchasings', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_po');
            $table->string('nama_barang');
            $table->integer('qty');
            $table->integer('harga');
            $table->string('supplier');
            $table->integer('total_harga');
            $table->string('keterangan')->nullable();
            $table->enum('status', ['pengajuan', 'verifikasi', 'setuju', 'tolak'])->default('pengajuan');
            $table->dateTime('disetujui_pada')->nullable();
            $table->string('disetujui_oleh')->nullable();
            $table->string('input_by');
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
        Schema::dropIfExists('purchasings');
    }
}

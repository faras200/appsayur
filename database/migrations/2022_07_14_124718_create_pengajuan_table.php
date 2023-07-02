<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('persetujuan_id');
            $table->foreignId('ormawa_id');
            $table->string('subjek');
            $table->enum('jenis', ['proposal', 'lpj', 'lainnya'])->default('lainnya');
            $table->string('catatan_revisi');
            $table->enum('status', ['proses', 'setuju', 'revisi', 'tolak'])->default('proses');
            $table->string('file');
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
        Schema::dropIfExists('pengajuan');
    }
}

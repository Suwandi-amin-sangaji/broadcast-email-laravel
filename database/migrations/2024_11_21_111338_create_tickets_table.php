<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('bib_number'); // NOMOR BIB
            $table->string('name'); // NAMA
            $table->string('category'); // KATEGORI
            $table->string('jersey_size'); // UKURAN JERSEY
            $table->string('phone_number'); // NOMOR HENDPHONE
            $table->string('email'); // ALAMAT EMAIL
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};

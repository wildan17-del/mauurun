<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('nama_event');
            $table->enum('jenis_event', ['3K', '5K', '10K', 'Half Maraton', 'Full Maraton']);
            $table->date('tanggal');
            $table->string('kota');
            $table->unsignedBigInteger('harga')->default(0);
            $table->unsignedInteger('kuota')->default(0);
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->index('jenis_event');
            $table->index('kota');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

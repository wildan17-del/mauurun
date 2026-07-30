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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('nama_lengkap');
            $table->string('email');
            $table->string('no_hp', 20);
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->enum('ukuran_jersey', ['S', 'M', 'L', 'XL', 'XXL']);
            $table->string('kode_kupon', 20)->nullable();
            $table->unsignedBigInteger('potongan_harga')->default(0);
            $table->unsignedBigInteger('harga_akhir')->default(0);
            $table->timestamps();

            $table->unique(['user_id', 'event_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};

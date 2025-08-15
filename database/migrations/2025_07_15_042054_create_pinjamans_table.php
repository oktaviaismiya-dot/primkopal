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
        Schema::create('pinjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal_pengajuan');
            $table->decimal('jumlah', 12, 2);
            $table->enum('status', ['pending', 'disetujui', 'ditolak', 'dicairkan', 'lunas']);
            $table->integer('tenor');
            $table->decimal('bunga', 5, 2);
            $table->foreignId('slip_gaji_id')->constrained('slip_gajis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjamans');
    }
};

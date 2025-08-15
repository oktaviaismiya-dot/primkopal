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
        Schema::create('angsuran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pinjaman_id')->constrained('pinjamans')->onDelete('cascade');
            $table->date('tanggal');
            $table->integer('angsuran_ke');
            $table->decimal('jumlah_bayar', 12, 2);
            $table->decimal('sisa_pembayaran', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('angsuran');
    }
};

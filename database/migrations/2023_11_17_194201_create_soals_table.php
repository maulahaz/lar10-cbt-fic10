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
            Schema::create('tbl_soal', function (Blueprint $table) {
                $table->id();
                $table->string('pertanyaan');
                $table->string('kategori');
                $table->string('opsi_a');
                $table->string('opsi_b');
                $table->string('opsi_c');
                $table->string('opsi_d');
                $table->enum('jawaban', ['a', 'b','c','d']);
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_soal');
    }
};

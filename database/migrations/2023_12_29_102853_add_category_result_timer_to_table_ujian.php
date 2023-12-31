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
        Schema::table('tbl_ujian', function (Blueprint $table) {
            $table->string('category')->nullable();
            $table->enum('status',['start', 'done'])->default('start');
            $table->integer('timer')->default(15);
            $table->integer('score')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_ujian', function (Blueprint $table) {
            //
        });
    }
};

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
            //--Adding Status Ujian (enum ==> start or done):
            $table->enum('status_area1',['start', 'done'])->default('start');
            $table->enum('status_area2',['start', 'done'])->default('start');
            $table->enum('status_area3',['start', 'done'])->default('start');
            $table->enum('status_area9',['start', 'done'])->default('start');
            //--Add timer per kategori:
            $table->integer('timer_area1')->nullable();
            $table->integer('timer_area2')->nullable();
            $table->integer('timer_area3')->nullable();
            $table->integer('timer_area9')->nullable();
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

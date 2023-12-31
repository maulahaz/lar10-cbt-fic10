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
        Schema::create('tbl_ujian', function (Blueprint $table) {
            $table->id();
            //--UserId
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // $table->bigInteger('user_id')->constrained();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //--Nilai
            // $table->integer('nilai_angka')->nullable();
            // $table->integer('nilai_verbal')->nullable();
            // $table->integer('nilai_logika')->nullable();
            $table->integer('nilai_area1')->nullable();
            $table->integer('nilai_area2')->nullable();
            $table->integer('nilai_area3')->nullable();
            $table->integer('nilai_area9')->nullable();
            //--hasil
            $table->string('hasil')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_ujian');
    }
};

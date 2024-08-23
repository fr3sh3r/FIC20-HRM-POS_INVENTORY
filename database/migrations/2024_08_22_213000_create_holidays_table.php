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
        Schema::create('holidays', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('name');   //nama dari hari libur
            $table->integer('year');  //Tahun dari hari libur tersebut. 2024
            $table->integer('month'); //Bulan dari hari libur tersebut (dalam format integer, misalnya 1 untuk Januari, 2 untuk Februari, dan seterusnya).
            $table->date('date');     //Tanggal spesifik dari hari libur tersebut (misalnya 2024-12-25 untuk Hari Natal).
            $table->boolean('is_weekend')->default(0);
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('holidays');
    }
};

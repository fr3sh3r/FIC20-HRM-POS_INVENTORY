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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('description')->nullable();

            $table->timestamps();
        });
    }

    /**Model dan Foreign Key
Sedangkan, ketika Anda membuat model di Laravel,
Anda biasanya tidak perlu mendefinisikan foreignId secara eksplisit di dalam model itu sendiri.
Hal ini karena foreign key biasanya didefinisikan di tingkat database melalui migrasi, bukan di dalam model.

Namun, dalam model, Anda dapat mendefinisikan relasi untuk menggunakan foreign key tersebut,
misalnya menggunakan metode belongsTo atau hasMany:
     **/

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};

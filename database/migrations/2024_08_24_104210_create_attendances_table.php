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
        //code di bawah ini berbeda dengan CodeBahri, karena ada penyempurnaan dari ChatGPT
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');

            $table->unsignedBigInteger('leave_id')->nullable();
            $table->unsignedBigInteger('leave_type_id')->nullable();
            $table->unsignedBigInteger('holiday_id')->nullable();

            $table->date('date');
            $table->boolean('is_holiday')->default(0);
            $table->boolean('is_leave')->default(0);
            $table->dateTime('clock_in_date_time')->nullable();
            $table->dateTime('clock_out_date_time')->nullable();
            $table->integer('total_duration')->nullable();
            $table->boolean('is_late')->default(0);
            $table->boolean('is_half_day')->default(0);
            $table->boolean('is_paid')->default(1);
            $table->string('status')->default('present');
            $table->text('reason')->nullable();

            $table->timestamps();

            // Adding foreign key constraints after defining the columns
            $table->foreign('leave_id')->references('id')->on('leaves')->onDelete('set null');
            $table->foreign('leave_type_id')->references('id')->on('leave_types')->onDelete('set null');
            $table->foreign('holiday_id')->references('id')->on('holidays')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};

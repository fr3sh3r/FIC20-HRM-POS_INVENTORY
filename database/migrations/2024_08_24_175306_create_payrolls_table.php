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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->integer('month');
            $table->integer('year');
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('net_salary', 10, 2);
            $table->integer('total_days');
            $table->integer('working_days');
            $table->integer('present_days');
            $table->integer('total_office_time');
            $table->integer('total_worked_time');
            $table->integer('half_day');
            $table->integer('late_days');
            $table->integer('paid_leaves');
            $table->integer('unpaid_leaves');
            $table->integer('holiday_count');
            $table->date('payment_date')->nullable();
            $table->string('status')->default('generated');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};

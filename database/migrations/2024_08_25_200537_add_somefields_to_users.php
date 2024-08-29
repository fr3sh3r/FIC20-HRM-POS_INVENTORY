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
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom setelah 'id'
            $table->string('username')->unique()->after('id');
            $table->unsignedBigInteger('company_id')->after('username');
            $table->boolean('is_superadmin')->default(false)->after('company_id');
            $table->unsignedBigInteger('role_id')->after('is_superadmin');
            $table->string('user_type')->default('employee')->after('role_id');
            $table->boolean('login_enabled')->default(true)->after('user_type');
            $table->string('profile_image')->nullable()->after('login_enabled');
            $table->string('status')->default('Enable')->after('profile_image');
            $table->string('phone')->nullable()->after('status');
            $table->text('address')->nullable()->after('phone');
            $table->unsignedBigInteger('department_id')->nullable()->after('address');
            $table->unsignedBigInteger('designation_id')->nullable()->after('department_id');
            $table->unsignedBigInteger('shift_id')->nullable()->after('designation_id');

            //nambah 3 kolom buat check siapa yang bikin, edit, dan hapus
            $table->unsignedBigInteger('created_by')->nullable()->after('shift_id');
            $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
            $table->unsignedBigInteger('deleted_by')->nullable()->after('updated_by');



            // Tambahkan foreign keys
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade');
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');

            // Foreign keys for audit columns
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus foreign keys
            $table->dropForeign(['company_id']);
            $table->dropForeign(['role_id']);
            $table->dropForeign(['department_id']);
            $table->dropForeign(['designation_id']);
            $table->dropForeign(['shift_id']);

            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);

            // Hapus kolom
            //$table->dropColumn(['username', 'company_id', 'is_superadmin', 'role_id', 'user_type', 'login_enabled', 'profile_image', 'status', 'phone', 'address', 'department_id', 'designation_id', 'shift_id']);
            $table->dropColumn(['username', 'company_id', 'is_superadmin', 'role_id', 'user_type', 'login_enabled', 'profile_image', 'status', 'phone', 'address', 'department_id', 'designation_id', 'shift_id', 'created_by', 'updated_by', 'deleted_by']);
        });
    }
};

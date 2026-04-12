<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('test_results', function (Blueprint $table) {
            // Menambahkan kolom Nama Lengkap dan Kelas setelah user_id
            $table->string('fullname')->after('user_id')->nullable();
            $table->string('class_grade')->after('fullname')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('test_results', function (Blueprint $table) {
            $table->dropColumn(['fullname', 'class_grade']);
        });
    }
};
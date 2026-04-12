<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('categories', function (Blueprint $table) {
        $table->id();
        $table->string('code'); // Contoh: ART, SOC
        $table->string('name'); // Contoh: Artistic
        $table->text('description'); // Penjelasan kepribadian
        $table->text('majors'); // Jurusan yang cocok
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

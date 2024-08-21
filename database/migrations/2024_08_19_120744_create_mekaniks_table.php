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
        Schema::create('mekaniks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gl_wali_id')->constrained('gl_walis', 'id');
            $table->foreignId('mekanik_id')->constrained('users', 'id');
            $table->enum('status', ['MAP', 'IDP', 'MM']);
            $table->enum('section', ['Crusher', 'Minimex', 'SSE', 'Track', 'Wheel']);
            $table->integer('grade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mekaniks');
    }
};

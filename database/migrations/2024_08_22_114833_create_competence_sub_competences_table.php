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
        Schema::create('competence_sub_competences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competence_id')->constrained('competences');
            $table->foreignId('sub_competence_id')->constrained('sub_competences');
            $table->string('code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competence_sub_competences');
    }
};

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
        Schema::create('competence_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_competence_id')->constrained();
            $table->foreignId('sub_egi_id')->constrained();
            $table->string('score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competence_scores');
    }
};

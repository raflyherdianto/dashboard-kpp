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
        Schema::create('raport_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('raport_id')->constrained();
            $table->foreignId('egi_id')->constrained();
            $table->foreignId('competence_id')->constrained();
            $table->foreignId('sub_competence_id')->constrained();
            $table->year('year');
            $table->integer('point')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raport_details');
    }
};

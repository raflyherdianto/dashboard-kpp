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
        Schema::create('history_pelatihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mekanik_id')->nullable()->constrained('users', 'id');
            $table->foreignId('instruktur_id')->nullable()->constrained('users', 'id');
            $table->foreignId('site_id')->nullable()->constrained();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->string('location')->nullable();
            $table->foreignId('pelatihan_id')->nullable()->constrained();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('sub_egi')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_pelatihans');
    }
};

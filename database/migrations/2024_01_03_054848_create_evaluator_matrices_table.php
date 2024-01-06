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
        Schema::create('evaluator_matrices', function (Blueprint $table) {
            $table->id();
            
            // Fields
            $table->unsignedBigInteger('evaluator_id');
            $table->unsignedBigInteger('matrix_id');
            $table->timestamps();
            
            // References
            $table->foreign('evaluator_id')->references('id')->on('users');
            $table->foreign('matrix_id')->references('id')->on('matrices');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluator_matrices');
    }
};

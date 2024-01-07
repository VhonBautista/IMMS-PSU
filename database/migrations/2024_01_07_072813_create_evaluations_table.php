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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            
            // Fields
            $table->unsignedBigInteger('matrix_id');
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('evaluator_id');
            $table->text('passed_criteria');
            $table->text('comment');
            $table->enum('status', ['passed', 'failed']);
            $table->timestamps();
            
            // References
            $table->foreign('matrix_id')->references('id')->on('matrices');
            $table->foreign('material_id')->references('id')->on('instructional_materials');
            $table->foreign('evaluator_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};

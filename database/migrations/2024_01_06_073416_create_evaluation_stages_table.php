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
        Schema::create('evaluation_stages', function (Blueprint $table) {
            $table->id();
            
            // Fields
            $table->unsignedBigInteger('matrix_id');
            $table->unsignedBigInteger('material_id');
            $table->timestamps();
            
            // References
            $table->foreign('matrix_id')->references('id')->on('matrices');
            $table->foreign('material_id')->references('id')->on('instructional_materials');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_stages');
    }
};

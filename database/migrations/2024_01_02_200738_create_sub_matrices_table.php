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
        Schema::create('sub_matrices', function (Blueprint $table) {
            $table->id();
            
            // Fields
            $table->string('title');
            $table->unsignedBigInteger('matrix_id');
            $table->timestamps();
            
            // References
            $table->foreign('matrix_id')->references('id')->on('matrices');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_matrices');
    }
};

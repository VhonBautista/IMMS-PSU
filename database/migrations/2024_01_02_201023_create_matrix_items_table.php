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
        Schema::create('matrix_items', function (Blueprint $table) {
            $table->id();
            
            // Fields
            $table->string('item');
            $table->text('text');
            $table->integer('score')->default(0);
            $table->unsignedBigInteger('sub_matrix_id');
            $table->timestamps();
            
            // References
            $table->foreign('sub_matrix_id')->references('id')->on('sub_matrices');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matrix_items');
    }
};

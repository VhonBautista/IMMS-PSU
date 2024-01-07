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
        Schema::create('matrices', function (Blueprint $table) {
            $table->id();
            
            // Fields
            $table->string('matrix_name');
            $table->text('description');
            $table->enum('level', ['campus', 'university']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matrices');
    }
};

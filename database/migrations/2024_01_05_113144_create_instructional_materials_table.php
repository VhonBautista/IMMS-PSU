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
        Schema::create('instructional_materials', function (Blueprint $table) {
            $table->id();
            
            // Fields
            $table->string('title');
            $table->text('pdf_path');
            $table->text('proponents');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('campus_id');
            $table->unsignedBigInteger('submitter_id');
            $table->enum('type', ['course_book', 'textbook', 'modules', 'laboratory manual', 'prototype', 'others']);
            $table->enum('status', ['pending', 'evaluating', 'resubmission', 'approved']);
            $table->timestamps();
            
            // References
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('campus_id')->references('id')->on('campuses');
            $table->foreign('submitter_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructional_materials');
    }
};

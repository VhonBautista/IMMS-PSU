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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Fields
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('univ_role_id');
            $table->unsignedBigInteger('campus_id');
            $table->timestamps();
            
            // References
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('univ_role_id')->references('id')->on('university_roles');
            $table->foreign('campus_id')->references('id')->on('campuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

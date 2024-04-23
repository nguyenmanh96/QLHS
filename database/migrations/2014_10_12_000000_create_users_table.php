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
            $table->increments('id');
            $table->string('email',255)->nullable()->unique();
            $table->string('password',255)->nullable();
            $table->enum('type',['Admin','Student'])->nullable();
            $table->string('avatar',255);
            $table->string('google_token',50)->nullable();
            $table->integer('student_id')->unique()->nullable();
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

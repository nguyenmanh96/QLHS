<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email',255)->unique();
            $table->string('password',255);
            $table->enum('type',['Admin','Student']);
            $table->string('avatar',255);
            $table->string('google_token',50)->nullable();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('users',function (Blueprint $table){
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });

        Schema::table('students',function (Blueprint $table){
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });

        Schema::table('subjects',function (Blueprint $table){
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });

        Schema::table('results',function (Blueprint $table){
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });

        Schema::table('results',function (Blueprint $table){
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });

        Schema::table('register_subjects',function (Blueprint $table){
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });

    }


    public function down(): void
    {
        //
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users',function (Blueprint $table){
            $table->string('avatar',255)->default('default_avt.png')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users',function (Blueprint $table){
            $table->string('avatar',255)->default('public.default_avt.png')->change();
        });
    }
};

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
            $table->String('username')->unique();
            $table->String('email')->unique();
            $table->String('password');

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

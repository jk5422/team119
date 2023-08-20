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
        Schema::create('patients', function (Blueprint $table) {
            $table->id('pid')->autoIncrement();
            $table->string('pname',50);
            $table->string('pmobile',10);
            $table->string('pemail',40)->nullable();
            $table->integer('page');
            $table->enum('pgender',['M','F']);
            $table->string('password');
            $table->string('paddress');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};

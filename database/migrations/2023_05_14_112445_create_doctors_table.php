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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id('did')->autoIncrement();
            $table->string('dname',50);
            $table->enum('dgender',['M','F']);
            $table->string('dmobile',10);
            $table->string('dpassword');
            $table->string('demail',40);
            $table->string('dqualification',20);
            $table->string('daddress');
            $table->unsignedBigInteger('clinics_cid');
            $table->foreign('clinics_cid')->references('cid')->on('clinics');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};

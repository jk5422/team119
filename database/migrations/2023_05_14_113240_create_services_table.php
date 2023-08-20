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
        Schema::create('services', function (Blueprint $table) {
            $table->id('sid')->autoIncrement();
            $table->string('sname',50);
            $table->unsignedBigInteger('doctors_did');
            $table->unsignedBigInteger('clinics_cid');
            $table->foreign('doctors_did')->references('did')->on('doctors');
            $table->foreign('clinics_cid')->references('cid')->on('clinics');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};

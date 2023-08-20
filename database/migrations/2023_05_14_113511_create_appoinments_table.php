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
        Schema::create('appoinments', function (Blueprint $table) {
            $table->id('apno')->autoIncrement();
            $table->date('apdate');
            $table->string('aptimeslot',25);
            $table->boolean('apstatus')->default('NULL');
            $table->unsignedBigInteger('doctors_did');
            $table->unsignedBigInteger('clinics_cid');
            $table->unsignedBigInteger('services_sid');
            $table->unsignedBigInteger('patients_pid');
            $table->foreign('clinics_cid')->references('cid')->on('clinics');
            $table->foreign('patients_pid')->references('pid')->on('patients');
            $table->foreign('doctors_did')->references('did')->on('doctors');
            $table->foreign('services_sid')->references('sid')->on('services');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appoinments');
    }
};

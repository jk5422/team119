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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payid');
            $table->string('paymentid')->nullable();
            $table->string('paymode',25);
            $table->unsignedBigInteger('appt_pid');
            $table->unsignedBigInteger('app_apno');
            $table->foreign('appt_pid')->references('patients_pid')->on('appoinments');
            $table->foreign('app_apno')->references('apno')->on('appoinments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

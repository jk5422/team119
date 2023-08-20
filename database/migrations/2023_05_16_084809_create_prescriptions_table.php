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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('appoinments_apno',false)->primary();
            $table->unsignedBigInteger('medicines_medid',false);
            $table->string('morning',2);
            $table->string('afternoon',2);
            $table->string('evening',2);
            $table->string('night',2);
            $table->string('remarks',100)->nullable();
            $table->foreign('appoinments_apno')->references('apno')->on('appoinments');
            $table->foreign('medicines_medid')->references('medicineid')->on('medicines');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};

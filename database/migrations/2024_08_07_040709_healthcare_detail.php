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
        Schema::create('healthcare_detail', function (Blueprint $table) {
            $table->id(); // This creates an auto-incrementing UNSIGNED BIGINT (primary key) column
            $table->string('doctor_name');
            $table->string('hospital_name');
            $table->string('disease_name');
            $table->string('address');
            $table->boolean('status'); // Status field as a boolean
            $table->unsignedBigInteger('doctor_contact_no'); // Use unsignedBigInteger for contact numbers
            $table->unsignedBigInteger('hospital_contact_no'); // Use unsignedBigInteger for contact numbers
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('healthcare_detail');
    }
};

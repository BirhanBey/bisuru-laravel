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
        Schema::create('farms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('farmers_id');
            $table->foreign('farmers_id')->references('id')->on('farmers')->onDelete('cascade');
            $table->boolean('status')->nullable();
            $table->string('address')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('surfaceArea')->nullable();
            $table->string('placeOfBirth')->nullable();
            $table->string('identityNumber')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farms');
    }
};

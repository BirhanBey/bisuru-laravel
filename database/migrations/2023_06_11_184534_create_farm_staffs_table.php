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
        Schema::create('farm_staff', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('farms_id');
            $table->foreign('farms_id')->references('id')->on('farms')->onDelete('cascade');
            $table->string('name');
            $table->string('surname');
            $table->string('department')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->boolean('status')->nullable();
            $table->string('maritalStatus')->nullable();
            $table->string('dateOfBirth')->nullable();
            $table->string('education')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farm_staff');
    }
};

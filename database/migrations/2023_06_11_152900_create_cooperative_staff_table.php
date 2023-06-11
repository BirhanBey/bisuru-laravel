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
        Schema::create('cooperative_staffs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cooperatives_id');
            $table->foreign('cooperatives_id')->references('id')->on('cooperatives')->onDelete('cascade');
            $table->string('name');
            $table->string('surname');
            $table->string('department')->nullable();
            $table->string('dateOfBirth')->nullable();
            $table->string('placeOfBirth')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('identityNumber')->nullable();
            $table->string('maritalStatus')->nullable();
            $table->string('numberOfKids')->nullable();
            $table->string('address')->nullable();
            $table->string('field')->nullable();
            $table->boolean('status')->nullable();
            $table->string('licenseNo')->nullable();
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
        Schema::dropIfExists('cooperative_staffs');
    }
};

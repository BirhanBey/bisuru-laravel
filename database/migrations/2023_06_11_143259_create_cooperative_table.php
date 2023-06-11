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
        Schema::create('cooperatives', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('admins_id');
            // $table->foreign('admins_id')->references('id')->on('admins')->onDelete('cascade');
            $table->string('name');
            $table->string('founded');
            $table->string('address');
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
        Schema::dropIfExists('cooperatives');
    }
};

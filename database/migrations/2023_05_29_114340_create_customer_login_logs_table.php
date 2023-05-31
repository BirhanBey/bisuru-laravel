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
        Schema::create('customer_login_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customers_id');
            $table->foreign('customers_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('loginType')->nullable();
            $table->string('browser')->nullable();
            $table->string('IP')->nullable();
            $table->string('browser_Lang')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamp('progressDate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_login_logs');
    }
};

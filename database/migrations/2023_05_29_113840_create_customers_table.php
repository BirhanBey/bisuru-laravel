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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_number')->nullable();
            $table->boolean('status')->nullable();
            $table->string('image')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });

        // Schema::create('customer_login_logs', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('customers_id');
        //     $table->foreign('customers_id')->references('id')->on('customers')->onDelete('cascade');
        //     $table->string('loginType')->nullable();
        //     $table->string('browser')->nullable();
        //     $table->string('IP')->nullable();
        //     $table->string('browser_Lang')->nullable();
        //     $table->boolean('status')->nullable();
        //     $table->timestamp('progressDate')->nullable();
        //     $table->timestamps();
        // });

        // Schema::create('customer_roles', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('mainID')->nullable();
        //     $table->string('title')->nullable();
        //     $table->boolean('status')->nullable();
        //     $table->timestamps();
        // });

        // Schema::create('customer_users_roles', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('customers_id');
        //     $table->unsignedBigInteger('customer_roles_id');
        //     $table->foreign('customers_id')->references('id')->on('customers')->onDelete('cascade');
        //     $table->foreign('customer_roles_id')->references('id')->on('customer_roles')->onDelete('cascade');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
        // Schema::dropIfExists('customer_login_logs');
        // Schema::dropIfExists('customer_roles');
        // Schema::dropIfExists('customer_users_roles');
    }
};

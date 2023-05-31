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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_number')->nullable();
            $table->boolean('status')->nullable();
            $table->string('image')->nullable();
            $table->timestamp('email_verified_at')->nullable();     
            $table->rememberToken();
            $table->timestamps();
            
        });

        // Schema::create('admin_login_logs', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('admins_id');
        //     $table->foreign('admins_id')->references('id')->on('admins')->onDelete('cascade');
        //     $table->string('loginType')->nullable();
        //     $table->string('browser')->nullable();
        //     $table->string('IP')->nullable();
        //     $table->string('browser_Lang')->nullable();
        //     $table->boolean('status')->nullable();
        //     $table->timestamp('progressDate')->nullable();
        //     $table->timestamps();
        // });

        // Schema::create('admin_roles', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('mainID')->nullable();
        //     $table->string('title')->nullable();
        //     $table->boolean('status')->nullable();
        //     $table->timestamps();
        // });

        // Schema::create('admin_users_roles', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('admins_id');
        //     $table->unsignedBigInteger('admin_roles_id');
        //     $table->foreign('admins_id')->references('id')->on('admins')->onDelete('cascade');
        //     $table->foreign('admin_roles_id')->references('id')->on('admin_roles')->onDelete('cascade');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
        // Schema::dropIfExists('admin_login_logs');
        // Schema::dropIfExists('admin_roles');
        // Schema::dropIfExists('admin_users_roles');
    }
};

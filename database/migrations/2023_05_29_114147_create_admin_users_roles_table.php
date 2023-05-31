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
        Schema::create('admin_users_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admins_id');
            $table->unsignedBigInteger('admin_roles_id');
            $table->foreign('admins_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('admin_roles_id')->references('id')->on('admin_roles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_users_roles');
    }
};

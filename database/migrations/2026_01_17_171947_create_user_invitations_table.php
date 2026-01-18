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
        Schema::create('user_invitations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_invitation_id')->nullable();
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->string('email')->unique();
            $table->string('role'); // Admin, Member, Sales, Manager
            $table->string('token')->unique();
            $table->unsignedBigInteger('invited_by'); // user id
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('invited_by')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_invitations');
    }
};

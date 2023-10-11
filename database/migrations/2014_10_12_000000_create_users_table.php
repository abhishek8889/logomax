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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('email_verified')->default(0);
            $table->integer('is_approved')->default(0);
            $table->string('password');
            $table->string('experience')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();
            // $table->stripe('stripe_customer_id')->nullable();
            $table->integer('status')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

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
        Schema::create('logo_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('logo_id');
            $table->text('title');
            $table->text('description');
            $table->string('approved');
            $table->string('rating');
            $table->string('status');
            $table->integer('home_page_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logo_reviews');
    }
};

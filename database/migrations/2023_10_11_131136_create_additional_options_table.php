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
        Schema::create('additional_options', function (Blueprint $table) {
            $table->id();
            $table->string('option_text');
            $table->string('option_type');
            $table->string('pricing_duration')->nullable();
            $table->integer('percentage')->nullable();
            $table->float('amount')->nullable();
            $table->string('currency')->default('usd');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_options');
    }
};

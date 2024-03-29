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
        Schema::create('logos', function (Blueprint $table) {
            $table->id();
            $table->string('logo_unique_id');
            $table->string('designer_id');
            $table->string('logo_name');
            $table->string('logo_slug');
            $table->string('media_id');
            $table->string('tags');
            $table->string('logo_type')->default('low-price');        ////premium or Low-priced
            $table->string('category_id');
            $table->string('style_id');
            $table->string('branch_id');
            $table->float('price_for_customer')->default(199);
            $table->float('price_for_designer')->default(50);
            $table->string('currency')->default('usd');
            $table->integer('approved_status')->default(0);
            $table->integer('status')->default(1);
            $table->text('admin_review')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logos');
    }
};

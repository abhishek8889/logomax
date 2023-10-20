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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_num');
            $table->string('user_id');
            $table->string('logo_id');
            $table->float('price');
            $table->string('taxes')->nullable();
            $table->float('tax_percent')->nullable();
            $table->string('discount_coupon_code')->nullable();
            $table->string('discount_amount')->nullable();
            $table->integer('logo_for_future_status')->default(0);
            $table->string('logo_for_future_price')->nullable();
            $table->integer('get_favicon_status')->default(0);
            $table->string('get_favicon_price')->nullable();
            $table->string('total_payment_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

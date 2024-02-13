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
            $table->string('subscription_renew_status')->default(0);
            $table->string('currency');
            $table->string('total_payment_amount');
            $table->integer('status')->default(0); // 0 if payment is not done and 1 if payment is done 
            $table->integer('on_revision')->default(0); // 0 if order is complete done , 1 if order is on revision
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

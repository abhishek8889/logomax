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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('payment_type')->nullable(); // Which type of payment it is done for logo purchase or designer payment
            $table->string('payment_gateway'); // which gateway we are using 
            $table->string('stripe_payment_intent')->nullable();
            $table->string('stripe_payment_method')->nullable();
            $table->string('currency');
            $table->string('total_amount');
            $table->string('status'); // Stripe or paypal payment status 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

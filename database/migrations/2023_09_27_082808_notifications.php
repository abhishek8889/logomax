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
        Schema::create('notifications',function(Blueprint $table){
            $table->id();
            $table->integer('is_read')->default(0);
            $table->string('sender_id')->default(0);
            $table->string('reciever_id');
            $table->string('message');
        });
    }
    /**
        * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};

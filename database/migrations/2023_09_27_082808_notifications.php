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
            $table->string('type');
            $table->string('sender_id')->default(0);
            $table->string('reciever_id')->default(0);
            $table->string('designer_id');
            $table->integer('logo_id')->nullable();
            $table->string('message');
            $table->timestamps();
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

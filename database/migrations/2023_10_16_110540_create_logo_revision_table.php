<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    /**
     * ::::::::::::  Note :::::::::::::
        *          Revision Status (enabled) = 0 => revision request send 
        *          Revision Status (disabled) = 1 => revision on work  
        *          Revision Status (disabled) = 2 => revision approved  
    */
    public function up(): void
    {
        Schema::create('logo_revision', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('order_num');
            $table->string('logo_id');
            $table->string('client_id');
            $table->string('designer_id');
            $table->integer('revision_time');
            $table->integer('status'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logo_revision');
    }
};

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
        Schema::create('logo_revisions', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('request_title');
            $table->text('request_description');
            $table->string('logo_id');
            $table->integer('revision_time')->nullable();
            $table->integer('status')->default(0); // 0  When request on revision // 1 approved by customer 
            $table->integer('assigned')->default(0); // 0 => not assigned , 1 => assigned to designer
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logo_revisions');
    }
};

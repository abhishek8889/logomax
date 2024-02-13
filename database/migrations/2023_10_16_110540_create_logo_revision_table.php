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
            $table->string('what_you_revised')->nullable(); // Logo or favicon 
            $table->string('request_title');
            $table->string('company_name')->nullable();
            $table->string('updates_by_designer')->nullable()->comment('Updated images made by designer'); // Updates made by designer sent for approval to the customer 
            $table->string('fonts')->nullable();
            $table->string('colors')->nullable();
            $table->string('file_path')->nullable();
            $table->text('request_description');
            $table->string('logo_id');
            // $table->integer('revision_time')->nullable();
            $table->string('assigned_designer_id');
            $table->string('backup_designer')->nullable();
            $table->string('duration')->nullable();
            $table->integer('status')->default(0); // 0  When request on revision // 1 approved by customer // 2 Sent for approval // 3 denied to work
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

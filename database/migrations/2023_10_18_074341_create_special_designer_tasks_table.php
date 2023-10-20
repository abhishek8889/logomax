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
        Schema::create('special_designer_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('logo_revision_id');
            $table->string('logo_id');
            $table->string('client_id');
            $table->string('assigned_designer_id');
            $table->string('backup_designer_id')->nullable();
            $table->integer('task_duration')->default(60)->comment('duration in minutes');
            $table->integer('status'); // assigned or on working , 1 done but not approved by customer , 2 disapproved by customer , 3 Approved by cutomer
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_designer_tasks');
    }
};

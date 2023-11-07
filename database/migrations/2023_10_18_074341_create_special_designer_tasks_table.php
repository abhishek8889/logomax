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
            $table->integer('status'); // 0 assigned or on working ,1 send for approval,2 approve by customer , 3 disapproved by customer , 4 task terminate , 5 no backup desginer left. ,
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

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
        Schema::create('completed_task', function (Blueprint $table) {
            $table->id();
            $table->string('task_id');
            $table->string('client_id');
            $table->string('designer_id');
            $table->string('logo_id');
            $table->string('media_id');
            $table->string('status')->default(0); // 0 means not approved by customer , 1 means approved by customer 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('completed_task');
    }
};

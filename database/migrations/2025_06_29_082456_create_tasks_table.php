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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('description', 1000)->nullable();
            $table->timestamps();
            $table->dateTime('due_date')->nullable();
            $table->boolean('due_date_notification_send')->default(false);
            $table->string('public_token', 64)->unique()->nullable();
            $table->dateTime('public_token_expires_at')->nullable()->default(null);
             	 
            $table->foreignId('status_id')
                  ->constrained(table: 'statuses', indexName: 'task_status_id')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreignId('priority_id')
                  ->constrained(table: 'priorities', indexName: 'task_priority_id')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreignId('user_id')
                  ->constrained(table: 'users', indexName: 'task_user_id')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

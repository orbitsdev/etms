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
        Schema::create('job_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requester_id')->constrained('users')->onDelete('cascade'); // User who requested the job
            $table->foreignId('assignee_id')->nullable()->constrained('users')->onDelete('set null'); // User assigned to fulfill the job
            $table->foreignId('updated_by_id')->nullable()->constrained('users')->onDelete('set null'); // User assigned to fulfill the job
            $table->string('assignee_name')->nullable(); // User assigned to fulfill the job
            $table->string('title')->nullable(); // Brief job title
            $table->text('description')->nullable(); // Detailed description of the job
            $table->enum('status', ['Pending', 'Approved', 'Completed', 'Cancelled', 'Failed'])->default('Pending'); // Job status

            $table->date('request_date')->nullable();
            $table->text('status_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_orders');
    }
};

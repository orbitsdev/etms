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
        Schema::create('request_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['Status Change', 'Date Change', 'Purpose Change']);
            $table->enum('old_status', ['Pending', 'Approved', 'Ready for Pickup', 'Picked Up', 'Delivered', 'Returned', 'Cancelled', 'Completed'])->nullable();
            $table->enum('new_status', ['Pending', 'Approved', 'Ready for Pickup', 'Picked Up', 'Delivered', 'Returned', 'Cancelled', 'Completed'])->nullable();
            $table->timestamp('old_request_date')->nullable();
            $table->timestamp('new_request_date')->nullable();
            $table->text('old_purpose')->nullable();
            $table->text('new_purpose')->nullable();
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_histories');
    }
};

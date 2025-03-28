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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('serial_number')->nullable()->unique();
            $table->integer('stock')->default(0);
            $table->enum('status', ['Available', 'Reserved', 'Not Available', 'Out of Stock', 'Under Maintenance', 'Archived'])->nullable()->default('Available');
            $table->string('location')->nullable();
        $table->timestamp('archived_date')->nullable();
            $table->text('issue_description')->nullable();
            $table->timestamp('reported_date')->nullable();
            $table->foreignId('reported_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};

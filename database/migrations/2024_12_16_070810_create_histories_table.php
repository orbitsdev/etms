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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['Status Change', 'Stock Change', 'Location Change', 'Maintenance Change', 'Archived Change']);
            $table->enum('old_status', ['Available', 'Reserved', 'Not Available', 'Out of Stock', 'Archived' , 'Under Maintenance',])->nullable();
            $table->enum('new_status', ['Available', 'Reserved', 'Not Available', 'Out of Stock', 'Archived' , 'Under Maintenance',])->nullable();
            $table->string('old_location')->nullable();
            $table->string('new_location')->nullable();
            $table->integer('old_stock')->nullable();
            $table->integer('new_stock')->nullable();
            $table->foreignId('updated_by')->constrained('users')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};

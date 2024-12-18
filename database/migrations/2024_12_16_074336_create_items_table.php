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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained()->onDelete('cascade');
            $table->foreignId('equipment_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('quantity')->default(1);
            $table->enum('status', [
                'Reserved',
                'Picked Up',
                'Returned',
                'Damaged',
                'Lost'
            ])->default('Reserved'); // Status of the specific item
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};

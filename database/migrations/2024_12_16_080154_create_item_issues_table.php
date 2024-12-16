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
        Schema::create('item_issues', function (Blueprint $table) {
            $table->id();

            $table->foreignId('request_item_id')->constrained('request_items')->onDelete('cascade');
            $table->foreignId('equipment_id')->constrained()->onDelete('cascade');
            $table->text('issue_description');
            $table->enum('issue_type', ['Damaged', 'Lost'])->default('Damaged');
            $table->decimal('repair_cost', 10, 2)->nullable();
            $table->enum('resolution_status', ['Pending', 'Fixed', 'Unfixable'])->default('Pending');
            $table->foreignId('reported_by')->constrained('users')->onDelete('cascade'); 
            $table->timestamp('reported_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_issues');
    }
};

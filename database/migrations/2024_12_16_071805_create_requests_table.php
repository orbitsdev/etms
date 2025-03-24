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


        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamp('request_date')->nullable();
            $table->timestamp('actual_return_date')->nullable();
            $table->timestamp('pickup_date')->nullable();
            $table->timestamp('return_date')->nullable();
            $table->enum('status', [
                'Pending',
                'Approved',
                'Ready for Pickup',
                'Picked Up',
                'Delivered',
            'Returned',
                'Cancelled',
                'Completed',
                'Due',
               ]
            )->default('Pending');
            $table->text('purpose')->nullable();
            $table->text('status_reason')->nullable();
            $table->json('user_snapshot')->nullable(); // Storing snapshots in JSON format
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('cascade');

            // $table->string('name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


// Pending	Request is awaiting approval.
// Approved	Request has been approved and is ready for the next step.
// Ready for Pickup	Equipment is ready for the user to pick up.
// Picked Up	Equipment has been collected by the user.
// Delivered	Equipment has been delivered to the user (optional).
// Returned	Equipment has been returned by the user.
// Cancelled	Request has been cancelled.
// Completed	The request is fully resolved, no further actions needed.
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
                'Completed'
               ]
            )->default('Pending');
            $table->text('purpose')->nullable();
            $table->string('user_name_snapshot')->nullable();
            $table->string('equipment_name_snapshot')->nullable();
            $table->string('equipment_serial_snapshot')->nullable();
            $table->string('equipment_department')->nullable();
            $table->foreignId('updated_by')->constrained('users')->onDelete('cascade');
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

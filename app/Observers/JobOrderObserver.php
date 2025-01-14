<?php

namespace App\Observers;

use App\Models\JobOrder;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NotificationController;

class JobOrderObserver
{
    /**
     * Handle the JobOrder "created" event.
     */
    public function created(JobOrder $jobOrder): void
    {
        //
    }

    /**
     * Handle the JobOrder "updated" event.
     */
    public function updated(JobOrder $jobOrder): void
    {
        if ($jobOrder->isDirty('status')) {
            \Log::info("Job Order ID {$jobOrder->id} status changed from {$jobOrder->getOriginal('status')} to {$jobOrder->status} by user ID: " . Auth::id());

            // Send a notification
            NotificationController::sendJobOrderNotification($jobOrder);
        }
    }

    /**
     * Handle the JobOrder "deleted" event.
     */
    public function deleted(JobOrder $jobOrder): void
    {
        //
    }

    /**
     * Handle the JobOrder "restored" event.
     */
    public function restored(JobOrder $jobOrder): void
    {
        //
    }

    /**
     * Handle the JobOrder "force deleted" event.
     */
    public function forceDeleted(JobOrder $jobOrder): void
    {
        //
    }
}

<?php

namespace App\Observers;

use App\Models\Request;
use App\Models\RequestHistory;
use Illuminate\Support\Facades\Auth;

class RequestObserver
{
    /**
     * Handle the Request "created" event.
     */
    public function created(Request $request): void
    {
        //
    }

    /**
     * Handle the Request "updated" event.
     */
    public function updated(Request $request): void
    {
        if ($request->isDirty('status')) {
            RequestHistory::create([
                'request_id' => $request->id,
                'type' => 'Status Change',
                'old_status' => $request->getOriginal('status'),
                'new_status' => $request->status,
                'updated_by' => Auth::id(),
                'description' => 'Status updated',
            ]);
        }

        // Track request date changes
        if ($request->isDirty('request_date')) {
            RequestHistory::create([
                'request_id' => $request->id,
                'type' => 'Date Change',
                'old_request_date' => $request->getOriginal('request_date'),
                'new_request_date' => $request->request_date,
                'updated_by' => Auth::id(),
                'description' => 'Request date updated',
            ]);
        }

        // Track purpose changes
        if ($request->isDirty('purpose')) {
            RequestHistory::create([
                'request_id' => $request->id,
                'type' => 'Purpose Change',
                'old_purpose' => $request->getOriginal('purpose'),
                'new_purpose' => $request->purpose,
                'updated_by' => Auth::id(),
                'description' => 'Purpose updated',
            ]);
        }
    }

    /**
     * Handle the Request "deleted" event.
     */
    public function deleted(Request $request): void
    {
        //
    }

    /**
     * Handle the Request "restored" event.
     */
    public function restored(Request $request): void
    {
        //
    }

    /**
     * Handle the Request "force deleted" event.
     */
    public function forceDeleted(Request $request): void
    {
        //
    }
}

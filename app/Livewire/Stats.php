<?php

namespace App\Livewire;

use App\Models\Request;
use Livewire\Component;
use Illuminate\Support\Carbon;

class Stats extends Component
{
    public function render()
    {
        $currentYear = Carbon::now()->year;

$totalPending = number_format(Request::pending()->whereYear('created_at', $currentYear)->count());
$totalApproved = number_format(Request::approved()->whereYear('created_at', $currentYear)->count());
$totalReadyForPickup = number_format(Request::readyToPickUp()->whereYear('created_at', $currentYear)->count());
$totalPickedUp = number_format(Request::pickedUp()->whereYear('created_at', $currentYear)->count());
$totalReturned = number_format(Request::returned()->whereYear('created_at', $currentYear)->count());
$totalCompleted = number_format(Request::completed()->whereYear('created_at', $currentYear)->count());
$totalCancelled = number_format(Request::cancelled()->whereYear('created_at', $currentYear)->count());

        return view('livewire.stats',
        compact(
            'totalPending',
            'totalApproved',
            'totalReadyForPickup',
            'totalPickedUp',
            'totalReturned',
            'totalCompleted',
            'totalCancelled'
        ));
    }
}

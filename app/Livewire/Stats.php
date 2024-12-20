<?php

namespace App\Livewire;

use App\Models\Request;
use Livewire\Component;

class Stats extends Component
{
    public function render()
    {
        $totalPending = number_format(Request::pending()->count());
        $totalApproved = number_format(Request::approved()->count());
        $totalReadyForPickup = number_format(Request::readyToPickUp()->count());
        $totalPickedUp = number_format(Request::pickedUp()->count());
        $totalReturned = number_format(Request::returned()->count());
        $totalCompleted = number_format(Request::completed()->count());

        return view('livewire.stats',
        compact(
            'totalPending',
            'totalApproved',
            'totalReadyForPickup',
            'totalPickedUp',
            'totalReturned',
            'totalCompleted'
        ));
    }
}

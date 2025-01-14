<?php

namespace App\Livewire;

use App\Models\JobOrder;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TotalJobOrderPendingRequest extends Component
{

    public $totalPending;
    public function render()
    {

          $currentYear = Carbon::now()->year;
        if( Auth::user()->notAdmin()){

            $this->totalPending = number_format(JobOrder::myOrders()->pending()->whereYear('created_at', $currentYear)->count());
        }else{

            $this->totalPending = number_format(JobOrder::pending()->whereYear('created_at', $currentYear)->count());
        }
        return view('livewire.total-job-order-pending-request');
    }
}

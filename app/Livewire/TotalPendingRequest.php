<?php

namespace App\Livewire;

use App\Models\Request;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TotalPendingRequest extends Component
{
  
    public $totalPending;

    public function render()
    {   
        $currentYear = Carbon::now()->year;
        if( Auth::user()->isRequester()){

            $this->totalPending = number_format(Request::myRequest()->pending()->whereYear('created_at', $currentYear)->count());
        }else{

            $this->totalPending = number_format(Request::pending()->whereYear('created_at', $currentYear)->count());
        }
        return view('livewire.total-pending-request');
    }
}

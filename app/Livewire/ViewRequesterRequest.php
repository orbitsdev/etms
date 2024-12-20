<?php

namespace App\Livewire;

use App\Models\Request;
use Livewire\Component;

class ViewRequesterRequest extends Component
{

    public  $record;
    public function mount($record)
    {


        $this->record = Request::withAllRelations()->withItemCounts()->findOrFail($record);
    }
    public function render()
    {
            
        return view('livewire.view-requester-request',['record' => $this->record]);
    }

   
}

<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ViewUserDetails extends Component
{

    public  $record;

    public function mount($record)
    {

        // Load the equipment record with relations using the scope
        $this->record = User::with('userDetails')->findOrFail($record);
    }

    public function render()
    {
        return view('livewire.view-user-details',[
            'record' => $this->record
        ]);
    }
}

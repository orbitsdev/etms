<?php

namespace App\Livewire;

use App\Models\Equipment;
use Livewire\Component;

class ViewEquipment extends Component
{
    public  $record;

    public function mount($record)
    {

        // Load the equipment record with relations using the scope
        $this->record = Equipment::withRelation()->findOrFail($record);
    }

    public function render()
    {
        return view('livewire.view-equipment', ['record' => $this->record]);
    }
}

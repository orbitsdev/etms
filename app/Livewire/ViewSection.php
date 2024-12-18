<?php

namespace App\Livewire;

use App\Models\Section;
use Livewire\Component;

class ViewSection extends Component
{
    public  $record;
    public function mount($record)
    {


        $this->record = Section::findOrFail($record);
    }
    public function render()
    {
        return view('livewire.view-section');
    }
}

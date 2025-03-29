<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Equipment;

class EquipmentPrintReport extends Component
{
    public string $status = 'all';

    public function getEquipmentsProperty()
    {
        $query = Equipment::query();

        if ($this->status !== 'all') {
            $query->where('status', $this->status);
        }

        return $query->latest()->get();
    }

    public function render()
    {
        return view('livewire.equipment-print-report', [
            'equipments' => $this->equipments, // from computed property
        ]);
    }
}

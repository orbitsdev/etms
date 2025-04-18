<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Equipment;

class EquipmentPrintReport extends Component
{
    public string $status = 'all';
    public string $sortBy = 'name';
    public string $sortDirection = 'asc';

    // Add updatedStatus method to handle status changes
    public function updatedStatus()
    {
        // This method is automatically called when the status property is updated
        // We don't need to do anything here, but it ensures Livewire knows to re-render
    }

    public function mount($status = 'all')
    {
        $this->status = $status;
    }

    public function getEquipmentsProperty()
    {
        $query = Equipment::query();

        if ($this->status !== 'all') {
            $query->where('status', $this->status);
        }

        return $query->orderBy($this->sortBy, $this->sortDirection)->get();
    }

    public function render()
    {
        // Add debugging information
        $equipments = $this->equipments;
        $count = $equipments->count();
        $filterStatus = $this->status;

        return view('livewire.equipment-print-report', [
            'equipments' => $equipments,
            'totalEquipment' => $count,
            'statuses' => Equipment::STATUS_OPTIONS,
            'currentDate' => now()->format('F d, Y h:i A'),
            'filterStatus' => $filterStatus, // Pass the current filter status for debugging
        ]);
    }
}

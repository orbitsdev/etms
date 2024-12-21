<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use App\Models\Equipment;
use Maatwebsite\Excel\Concerns\FromView;

class EquipmentExport implements FromView
{
    protected $status;

    public function __construct($status = 'all')
    {
        $this->status = $status;
    }

    public function view(): View
    {
        $query = Equipment::query();

        // Filter by status if provided
        if ($this->status !== 'all') {
            $query->where('status', $this->status);
        }

        $equipments = $query->latest()->get();

        return view('exports.equipment-export', [
            'equipments' => $equipments,
        ]);
    }
}

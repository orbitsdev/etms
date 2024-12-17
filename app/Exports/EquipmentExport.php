<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use App\Models\Equipment;
use Maatwebsite\Excel\Concerns\FromView;

class EquipmentExport implements FromView
{
    protected $equipment;

    public function __construct(Equipment $equipment)
    {
        $this->equipment = $equipment;
    }

    public function view(): View
    {
        return view('exports.equipment-export', [
            'equipment' => $this->equipment
        ]);
    }
}

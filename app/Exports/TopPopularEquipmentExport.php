<?php

namespace App\Exports;

use App\Models\Equipment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class TopPopularEquipmentExport implements FromView
{
    protected $limit;

    public function __construct($limit = 10)
    {
        $this->limit = $limit;
    }

    public function view(): View
    {
        $topPopularEquipment = Equipment::popular($this->limit)->get();

        return view('exports.popular_equipment', compact('topPopularEquipment'));
    }
}
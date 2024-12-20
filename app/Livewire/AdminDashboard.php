<?php

namespace App\Livewire;

use App\Models\Request;
use Livewire\Component;
use App\Models\Equipment;

class AdminDashboard extends Component
{
    public function render()
    {

        $topPopularEquipment = Equipment::popular()->limit(10)->get();
        $outOfStockEquipment = Equipment::outOfStock()->get();
        return view('livewire.admin-dashboard', [
            'topPopularEquipment'=> $topPopularEquipment,
            'outOfStockEquipment' => $outOfStockEquipment,

        ]);
    }
}

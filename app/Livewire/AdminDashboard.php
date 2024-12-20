<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Request;
use Livewire\Component;
use App\Models\Equipment;

class AdminDashboard extends Component
{
    public function render()
    {

        $topPopularEquipment = Equipment::popular()->limit(10)->get();
        $outOfStockEquipment = Equipment::outOfStock()->get();
        $mostActiveUser = User::mostCompletedRequests()->first();
        return view('livewire.admin-dashboard', [
            'topPopularEquipment'=> $topPopularEquipment,
            'outOfStockEquipment' => $outOfStockEquipment,
            'mostActiveUser' => $mostActiveUser,

        ]);
    }
}

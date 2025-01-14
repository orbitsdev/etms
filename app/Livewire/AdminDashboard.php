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
        // $outOfStockEquipment = Equipment::outOfStock()->get();

        $availableEquipment = Equipment::available()->get();
        $outOfStockEquipment = Equipment::outOfStock()->get();
        $underMaintenanceEquipment = Equipment::underMaintenance()->get();
        $reservedEquipment = Equipment::reserved()->get();
        $notAvailableEquipment = Equipment::notAvailable()->get();
        $archivedEquipment = Equipment::archived()->get();

        // equipment

        $availableEquipmentCount = Equipment::available()->count();
$outOfStockEquipmentCount = Equipment::outOfStock()->count();
$underMaintenanceEquipmentCount = Equipment::underMaintenance()->count();
$reservedEquipmentCount = Equipment::reserved()->count();
$notAvailableEquipmentCount = Equipment::notAvailable()->count();
$archivedEquipmentCount = Equipment::archived()->count();

        // reuest report
    $pendingRequestsCount = Request::pending()->count();
    $approvedRequestsCount = Request::approved()->count();
    $readyToPickUpRequestsCount = Request::readyToPickUp()->count();
    $pickedUpRequestsCount = Request::pickedUp()->count();
    $returnedRequestsCount = Request::returned()->count();
    $cancelledRequestsCount = Request::cancelled()->count();
    $completedRequestsCount = Request::completed()->count();
    $dueRequestsCount = Request::Due()->count();


        $mostActiveUser = User::mostCompletedRequests()->first();
        return view('livewire.admin-dashboard', [
            'topPopularEquipment'=> $topPopularEquipment,
            'mostActiveUser' => $mostActiveUser,

            'availableEquipment' => $availableEquipment,
            'outOfStockEquipment' => $outOfStockEquipment,
            'underMaintenanceEquipment' => $underMaintenanceEquipment,
            'reservedEquipment' => $reservedEquipment,
            'notAvailableEquipment' => $notAvailableEquipment,
            'archivedEquipment' => $archivedEquipment,

            // equipment
            'availableEquipmentCount' => $availableEquipmentCount,
            'outOfStockEquipmentCount' => $outOfStockEquipmentCount,
            'underMaintenanceEquipmentCount' => $underMaintenanceEquipmentCount,
            'reservedEquipmentCount' => $reservedEquipmentCount,
            'notAvailableEquipmentCount' => $notAvailableEquipmentCount,
            'archivedEquipmentCount' => $archivedEquipmentCount,

            // requiest

            'pendingRequestsCount' => $pendingRequestsCount,
            'approvedRequestsCount' => $approvedRequestsCount,
            'readyToPickUpRequestsCount' => $readyToPickUpRequestsCount,
            'pickedUpRequestsCount' => $pickedUpRequestsCount,
            'returnedRequestsCount' => $returnedRequestsCount,
            'cancelledRequestsCount' => $cancelledRequestsCount,
            'completedRequestsCount' => $completedRequestsCount,
            'dueRequestsCount' => $dueRequestsCount,

        ]);
    }
}

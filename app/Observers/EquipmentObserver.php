<?php

namespace App\Observers;

use App\Models\Equipment;
use App\Models\StockLogs;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FilamentForm;
use App\Http\Controllers\TrackingController;

class EquipmentObserver
{
    /**
     * Handle the Equipment "created" event.
     */
    public function created(Equipment $equipment): void
    {
        FilamentForm::success('test');
    }

    /**
     * Handle the Equipment "updated" event.
     */
    public function updated(Equipment $equipment): void
    {
        // if (Auth::check() && Auth::user()->isAdmin()) {
        //     if ($equipment->isDirty('stock')) {
        //         $oldStock = $equipment->getOriginal('stock');
        //         $newStock = $equipment->stock;
        //         $changeType = $newStock > $oldStock ? 'Addition' : 'Removal';
        //         $quantity = abs($newStock - $oldStock);

        //         StockLogs::create([
        //             'equipment_id' => $equipment->id,
        //             'change_type' => $changeType,
        //             'quantity' => $quantity,
        //             'reason' => $changeType === 'Addition' ? 'Stock updated by admin' : 'Stock reduced by admin',
        //             'updated_by' => Auth::id(),
        //         ]);
        //     }
        // }

        // Log Stock Changes
        if ($equipment->isDirty('stock')) {
            $oldStock = $equipment->getOriginal('stock');
            $newStock = $equipment->stock;


            TrackingController::logStockChange($equipment, $oldStock, $newStock,);


            if ($newStock <= 0 && $equipment->status !== 'Out of Stock') {
                $equipment->update(['status' => 'Out of Stock']);
            }

            TrackingController::logHistory($equipment, [
                'type' => 'Stock Change',
                'old_stock' => $oldStock,
                'new_stock' => $newStock,
            ], );
        }

        // Log Status Changes
        if ($equipment->isDirty('status')) {
            $oldStatus = $equipment->getOriginal('status');
            $newStatus = $equipment->status;

            // $equipment->updated_by = Auth::user()->id;

            // Log to history
            TrackingController::logHistory($equipment, [
                'type' => 'Status Change',
                'old_status' => $oldStatus ?? 'Unknown',
                'new_status' => $newStatus ?? 'Unknown',
            ], );
        }

        // Log Location Changes
        if ($equipment->isDirty('location')) {
            $oldLocation = $equipment->getOriginal('location');
            $newLocation = $equipment->location;

            // Log to history
            TrackingController::logHistory($equipment, [
                'type' => 'Location Change',
                'old_location' => $oldLocation ?? 'N/A',
                'new_location' => $newLocation ?? 'N/A',
            ], );
        }
    }

    /**
     * Handle the Equipment "deleted" event.
     */
    public function deleted(Equipment $equipment): void
    {
        //
    }

    /**
     * Handle the Equipment "restored" event.
     */
    public function restored(Equipment $equipment): void
    {
        //
    }

    /**
     * Handle the Equipment "force deleted" event.
     */
    public function forceDeleted(Equipment $equipment): void
    {
        //
    }
}

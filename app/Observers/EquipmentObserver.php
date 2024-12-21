<?php

namespace App\Observers;

use App\Models\Equipment;
use App\Models\StockLogs;
use App\Models\MaintenanceLog;
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
        
            // Log stock change
            TrackingController::logStockChange($equipment, $oldStock, $newStock);
        
            // Handle status updates based on stock
            if ($newStock <= 0 && $equipment->status !== 'Out of Stock') {
                // If stock is 0 or less, set status to 'Out of Stock'
                $equipment->update(['status' => 'Out of Stock']);
            } elseif ($newStock > 0 && $equipment->status === 'Out of Stock') {
                // If stock is greater than 0 and status is 'Out of Stock', update to 'Available'
                $equipment->update(['status' => 'Available']);
            }
        
            // Ensure status consistency even if not explicitly covered by the above conditions
          
        
            // Log history of the change
            TrackingController::logHistory($equipment, [
                'type' => 'Stock Change',
                'old_stock' => $oldStock,
                'new_stock' => $newStock,
            ]);
        }
      
        if ($equipment->status === 'Out of Stock' && $newStock > 0) {
            // Correct the status if stock is greater than 0 but the status was not updated
            $equipment->update(['status' => 'Available']);
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

            // if ($newStatus === 'Under Maintenance') {
            //     MaintenanceLog::create([
            //         'equipment_id' => $equipment->id,
            //         'issue_description' => 'Maintenance initiated due to status update.',
            //         'status' => 'Under Maintenance',
            //         'reported_by' => Auth::id(),
            //         'reported_date' => now(),
            //     ]);
            // }
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

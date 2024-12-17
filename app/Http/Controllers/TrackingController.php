<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Equipment;
use App\Models\StockLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackingController extends Controller
{

    public static function logStockChange(Equipment $equipment, $oldStock, $newStock, $reason = 'Stock updated by system'): void
    {



        if ($oldStock != $newStock) {

            $changeType = $newStock > $oldStock ? 'Addition' : 'Removal';
            $quantity = abs($newStock - $oldStock);

            // Log the stock change only
            StockLogs::create([
                'equipment_id' => $equipment->id,
                'change_type' => $changeType,
                'quantity' => $quantity,
                'reason' => $reason,
                'updated_by' => Auth::id() ?? null,
            ]);
        }
    }

    public static function logHistory(Equipment $equipment, array $changes, $reason = 'Equipment updated'): void
{

    $userName = Auth::user()->name ?? 'System';

    if (isset($changes['type']) && $changes['type'] === 'Stock Change') {
        $reason = "Stock updated by {$userName} (from {$changes['old_stock']} to {$changes['new_stock']})";
    } elseif (isset($changes['type']) && $changes['type'] === 'Status Change') {
        $reason = "Status changed by {$userName} (from '{$changes['old_status']}' to '{$changes['new_status']}')";
    } elseif (isset($changes['type']) && $changes['type'] === 'Location Change') {
        $reason = "Location updated by {$userName} (from '{$changes['old_location']}' to '{$changes['new_location']}')";
    } else {
        $reason = "{$reason} by {$userName}";
    }


    History::create([
        'equipment_id' => $equipment->id,
        'type' => $changes['type'] ?? 'Status Change',
        'old_status' => $changes['old_status'] ?? null,
        'new_status' => $changes['new_status'] ?? null,
        'old_location' => $changes['old_location'] ?? null,
        'new_location' => $changes['new_location'] ?? null,
        'old_stock' => $changes['old_stock'] ?? null,
        'new_stock' => $changes['new_stock'] ?? null,
        'updated_by' => Auth::id() ?? null,
        'description' => $reason, 
    ]);


}

}

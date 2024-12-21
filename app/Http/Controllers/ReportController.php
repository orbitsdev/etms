<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Exports\RequestsExport;
use App\Exports\EquipmentExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TopPopularEquipmentExport;

class ReportController extends Controller
{

    public function exportEquipmentDetails($id) {
        $equipment = Equipment::withAllRelations()->findOrFail($id);

        // Generate a dynamic filename
        $createdDate = $equipment->created_at
            ? $equipment->created_at->format('F j, Y')
            : 'Unknown_Date';
        $filename = $equipment->name . '_' . $equipment->serial_number . '_Created_' . $createdDate . '.xlsx';

        // Export with EquipmentExport
        return Excel::download(new EquipmentExport($equipment), $filename);
    }
    public function requestExport($status)
    {
     
        $filenameStatus = ucfirst($status); 
        $date = now()->format('F_j_Y');     
       
        $filename = "{$filenameStatus}_request_Exported_{$date}.xlsx";
    
        
        return Excel::download(new RequestsExport($status), $filename);
    }

    
public function exportEquipment($status = 'all')
{
    $filename = "Equipment_Export_{$status}_" . now()->format('Y-m-d') . ".xlsx";

    return Excel::download(new EquipmentExport($status), $filename);
}

public function exportPopularEquipment()
    {
        $filename = 'Popular_Equipment_' . now()->format('Y-m-d') . '.xlsx';

        return Excel::download(new TopPopularEquipmentExport(10), $filename);
    }
    
}

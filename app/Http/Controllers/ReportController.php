<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Exports\EquipmentExport;
use Maatwebsite\Excel\Facades\Excel;

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
}

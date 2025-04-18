<?php

namespace App\Exports;

use App\Models\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EquipmentRequestersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $status;

    public function __construct($status = 'all')
    {
        $this->status = $status;
    }

    public function collection()
    {
        $query = Request::with(['user.userDetails', 'equipments']);

        if ($this->status !== 'all') {
            $query->where('status', $this->status);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Request ID',
            'Requester Name',
            'Email',
            'Department',
            'Course',
            'Section',
            'Requested Equipment',
            'Purpose',
            'Status',
            'Requested Date',
            'Return Date',
        ];
    }

    public function map($request): array
    {
        $equipmentNames = $request->equipments->pluck('name')->implode(', ');
        
        return [
            $request->id,
            $request->user->userDetails->fullName ?? 'N/A',
            $request->user->email ?? 'N/A',
            $request->user->userDetails->department->name ?? 'N/A',
            $request->user->userDetails->course->name ?? 'N/A',
            $request->user->userDetails->section->name ?? 'N/A',
            $equipmentNames,
            $request->purpose,
            $request->status,
            $request->created_at->format('M d, Y'),
            $request->return_date ? date('M d, Y', strtotime($request->return_date)) : 'N/A',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}

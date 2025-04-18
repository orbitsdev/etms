<?php

namespace App\Exports;

use App\Models\JobOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class JobOrderRequestersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $status;

    public function __construct($status = 'all')
    {
        $this->status = $status;
    }

    public function collection()
    {
        $query = JobOrder::with(['user.userDetails']);

        if ($this->status !== 'all') {
            $query->where('status', $this->status);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Job Order ID',
            'Requester Name',
            'Email',
            'Department',
            'Course',
            'Section',
            'Job Type',
            'Description',
            'Location',
            'Status',
            'Requested Date',
            'Completed Date',
        ];
    }

    public function map($jobOrder): array
    {
        return [
            $jobOrder->id,
            $jobOrder->user->userDetails->fullName ?? 'N/A',
            $jobOrder->user->email ?? 'N/A',
            $jobOrder->user->userDetails->department->name ?? 'N/A',
            $jobOrder->user->userDetails->course->name ?? 'N/A',
            $jobOrder->user->userDetails->section->name ?? 'N/A',
            $jobOrder->job_type,
            $jobOrder->description,
            $jobOrder->location,
            $jobOrder->status,
            $jobOrder->created_at->format('M d, Y'),
            $jobOrder->completed_at ? date('M d, Y', strtotime($jobOrder->completed_at)) : 'N/A',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}

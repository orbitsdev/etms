<?php

namespace App\Exports;

use App\Models\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RequestsExport implements FromView
{
    protected $status;

    /**
     * Constructor to accept the status filter.
     */
    public function __construct($status = 'all')
    {
        $this->status = $status;
    }

    /**
     * Prepare the view for the export.
     */
    public function view(): View
    {
        $query = Request::with(['user', 'items.equipment']);

        // Apply status filter if not "all"
        if ($this->status !== 'all') {
            $query->where('status', $this->status);
        }

        $requests = $query->latest()->get();

        return view('exports.requests-export', [
            'requests' => $requests,
        ]);
    }
}

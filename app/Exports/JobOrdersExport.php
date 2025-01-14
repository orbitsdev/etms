<?php

namespace App\Exports;

use App\Models\JobOrder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class JobOrdersExport implements FromView
{
    protected $status;

    public function __construct($status = 'all')
    {
        $this->status = $status;
    }

    public function view(): View
    {
        $query = JobOrder::query();

        if ($this->status !== 'all') {
            $query->where('status', $this->status);
        }

        return view('exports.job-orders-export', [
            'jobOrders' => $query->get(),
        ]);
    }
}

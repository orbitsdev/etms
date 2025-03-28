<?php

namespace App\Livewire\Reports;

use App\Models\Request;
use Livewire\Component;

class PropertyAcknowledgementReport extends Component
{

    public $requestId;
    public $record;

    public function mount($requestId)
    {
        $this->requestId = $requestId;
        $this->record = Request::with(['user', 'items'])->findOrFail($requestId);
    }

    public function render()
    {
        return view('livewire.reports.property-acknowledgement-report');
    }
}

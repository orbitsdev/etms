<?php

namespace App\Livewire\JobOrders;

use Filament\Forms;
use Livewire\Component;
use App\Models\JobOrder;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateJobOrder extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(FilamentForm::JobOrderform())
            ->statePath('data')
            ->model(JobOrder::class);
    }

    public function create()
    {
        $data = $this->form->getState();
        $data['requester_id']= Auth::user()->id;

        $record = JobOrder::create($data);
        $this->form->model($record)->saveRelationships();
        FilamentForm::success('Equipment created successfully');
        return redirect()->route('joborders.index');
    }

    public function render(): View
    {
        return view('livewire.job-orders.create-job-order');
    }
}

<?php

namespace App\Livewire\Requests;

use Filament\Forms;
use App\Models\Request;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class RequestEquipmentForm extends Component implements HasForms
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
            ->schema(FilamentForm::requestEquipmentForm())->columns(4)
            ->statePath('data')
            ->model(Request::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Request::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.requests.request-equipment-form');
    }
}

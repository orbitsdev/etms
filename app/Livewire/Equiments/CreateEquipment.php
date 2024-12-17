<?php

namespace App\Livewire\Equiments;

use Filament\Forms;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\Equipment;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateEquipment extends Component implements HasForms
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
            ->schema(FilamentForm::equipmentForm())
            ->statePath('data')
            ->model(Equipment::class);
    }

    public function create()
    {
        $data = $this->form->getState();

        $record = Equipment::create($data);

        $this->form->model($record)->saveRelationships();
        FilamentForm::success('Equipment created successfully');
        return redirect()->route('equipment.index');
    }

    public function render(): View
    {
        return view('livewire.equiments.create-equipment');
    }


}

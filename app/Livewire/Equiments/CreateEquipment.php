<?php

namespace App\Livewire\Equiments;

use App\Models\Equipment;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

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
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->maxLength(191),
                Forms\Components\TextInput::make('serial_number')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\TextInput::make('location')
                    ->maxLength(191),
                Forms\Components\DateTimePicker::make('archived_date'),
            ])
            ->statePath('data')
            ->model(Equipment::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Equipment::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.equiments.create-equipment');
    }
}
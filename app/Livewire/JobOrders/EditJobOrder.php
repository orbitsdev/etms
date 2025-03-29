<?php

namespace App\Livewire\JobOrders;

use App\Models\JobOrder;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class EditJobOrder extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public JobOrder $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('requester_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('assignee_id')
                    ->numeric(),
                Forms\Components\TextInput::make('assignee_name')
                    ->maxLength(191),
                Forms\Components\TextInput::make('title')
                    ->maxLength(191),
                Forms\Components\Textarea::make('description')->label('Problem Description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('status')
                    ->required(),
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);
    }

    public function render(): View
    {
        return view('livewire.job-orders.edit-job-order');
    }
}

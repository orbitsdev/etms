<?php

namespace App\Livewire\UserDetails;

use App\Models\UserDetails;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class CreateUserDetails extends Component implements HasForms
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
                Forms\Components\TextInput::make('first_name')
                    ->maxLength(191),
                Forms\Components\TextInput::make('middle_name')
                    ->maxLength(191),
                Forms\Components\TextInput::make('last_name')
                    ->maxLength(191),
                Forms\Components\TextInput::make('type')
                    ->required(),
                Forms\Components\TextInput::make('building')
                    ->maxLength(191),
                Forms\Components\TextInput::make('department')
                    ->maxLength(191),
                Forms\Components\TextInput::make('course')
                    ->maxLength(191),
                Forms\Components\TextInput::make('section')
                    ->maxLength(191),
                Forms\Components\TextInput::make('position')
                    ->maxLength(191),
                Forms\Components\TextInput::make('year')
                    ->maxLength(191),
            ])
            ->statePath('data')
            ->model(UserDetails::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = UserDetails::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.user-details.create-user-details');
    }
}

<?php

namespace App\Livewire\Users;

use Filament\Forms;
use App\Models\User;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateUser extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        // FilamentForm::user2Form()
        return $form
            ->schema(FilamentForm::user2Form())
        ->statePath('data')
            ->model(User::class);
    }

    public function create()
    {
        $data = $this->form->getState();

        $record = User::create($data);

        $this->form->model($record)->saveRelationships();
        FilamentForm::success('User created successfully');
        return redirect()->route('users.index');
    }

    public function render(): View
    {
        return view('livewire.users.create-user');
    }
}
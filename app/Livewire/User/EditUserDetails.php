<?php

namespace App\Livewire\User;

use App\Http\Controllers\FilamentForm;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class EditUserDetails extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public User $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(FilamentForm::userForm())
            ->statePath('data')
            ->model($this->record);
    }

    public function save()
    {
        $data = $this->form->getState();

        $this->record->update($data);
        FilamentForm::success('Details Updated successfully');
        return $this->record->getRedirectRouteBasedOnRole();
    }

    public function render(): View
    {
        return view('livewire.user.edit-user-details');
    }
}

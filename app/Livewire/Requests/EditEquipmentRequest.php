<?php

namespace App\Livewire\Requests;

use Filament\Forms;
use App\Models\Request;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class EditEquipmentRequest extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Request $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
        ->schema(FilamentForm::requestEquipmentForm())->columns(4)
            ->statePath('data')
            ->model($this->record);
    }

    public function save()
    {
        $data = $this->form->getState();

        $user = Auth::user();
        $userDetails = $user->userDetails;


        $data['user_id'] = $user->id;

       
        $data['user_snapshot'] = [
            'name' => $userDetails->fullName,
            'department' => $userDetails->department ?? '',
            'position' => $userDetails->isFaculty() ? $userDetails->position ?? '' : null,
            'course' => $userDetails->isStudent() ? $userDetails->course ?? '' : null,
            'section' => $userDetails->isStudent() ? $userDetails->section ?? '' : null,
        ];
        $this->record->update($data);
        FilamentForm::success('Equipment created successfully');
        return redirect()->route('requests.index');;
    }

    public function render(): View
    {
        return view('livewire.requests.edit-equipment-request');
    }
}

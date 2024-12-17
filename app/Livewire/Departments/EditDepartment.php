<?php

namespace App\Livewire\Departments;

use Filament\Forms;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\Department;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class EditDepartment extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Department $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
        ->schema(FilamentForm::departmentForm())

            ->statePath('data')
            ->model($this->record);
    }

    public function save()
    {
        $data = $this->form->getState();

        $this->record->update($data);
        FilamentForm::success('Department updated successfully');
        return redirect()->route('department.index');
    }

    public function render(): View
    {
        return view('livewire.departments.edit-department');
    }
}

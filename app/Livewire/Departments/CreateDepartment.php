<?php

namespace App\Livewire\Departments;

use App\Http\Controllers\FilamentForm;
use App\Models\Department;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class CreateDepartment extends Component implements HasForms
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
            ->schema(FilamentForm::departmentForm())
            ->statePath('data')
            ->model(Department::class);
    }

    public function create()
    {
        $data = $this->form->getState();

        $record = Department::create($data);

        
        $this->form->model($record)->saveRelationships();
        FilamentForm::success('Department created successfully');
        return redirect()->route('department.index');
    }

    public function render(): View
    {
        return view('livewire.departments.create-department');
    }
}
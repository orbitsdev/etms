<?php

namespace App\Livewire\Sections;

use App\Http\Controllers\FilamentForm;
use App\Models\Section;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class CreateSections extends Component implements HasForms
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
            ->schema(FilamentForm::sectionForm())
            ->statePath('data')
            ->model(Section::class);
    }

    public function create()
    {
        $data = $this->form->getState();

        $record = Section::create($data);

        $this->form->model($record)->saveRelationships();
        FilamentForm::success('Section created successfully');
        return redirect()->route('sections.index');
    }

    public function render(): View
    {
        return view('livewire.sections.create-sections');
    }
}
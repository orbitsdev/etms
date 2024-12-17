<?php

namespace App\Livewire\Sections;

use Filament\Forms;
use App\Models\Section;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class EditSections extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Section $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
        ->schema(FilamentForm::sectionForm())

            ->statePath('data')
            ->model($this->record);
    }

    public function save()
    {
        $data = $this->form->getState();

        $this->record->update($data);

        FilamentForm::success('Section updated successfully');
        return redirect()->route('sections.index');
    }

    public function render(): View
    {
        return view('livewire.sections.edit-sections');
    }
}

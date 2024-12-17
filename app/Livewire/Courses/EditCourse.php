<?php

namespace App\Livewire\Courses;

use Filament\Forms;
use App\Models\Course;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class EditCourse extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Course $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
        ->schema(FilamentForm::courseForm())

            ->statePath('data')
            ->model($this->record);
    }

    public function save()
    {
        $data = $this->form->getState();

        $this->record->update($data);
        FilamentForm::success('Course updated successfully');
        return redirect()->route('courses.index');
    }

    public function render(): View
    {
        return view('livewire.courses.edit-course');
    }
}

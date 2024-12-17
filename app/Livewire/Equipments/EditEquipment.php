<?php

namespace App\Livewire\Equipments;

use Filament\Forms;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\Equipment;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\TrackingController;
use Filament\Forms\Concerns\InteractsWithForms;

class EditEquipment extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Equipment $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
        ->schema(FilamentForm::equipmentForm())
            ->statePath('data')
            ->model($this->record);
    }

    public function save()
    {
        $data = $this->form->getState();

        // Capture the old stock value before updating
        $oldStock = $this->record->getOriginal('stock');
        $newStock = $data['stock'];



        // Update the record
        $this->record->update($data);

        // Log the stock change
   $name = Auth::user()->name;
        TrackingController::logStockChange($this->record, $oldStock, $newStock, 'Stock updated by '.$name);

        FilamentForm::success('Equipment updated successfully');
        return redirect()->route('equipment.index');
    }

    public function render(): View
    {
        return view('livewire.equipments.edit-equipment');
    }
}

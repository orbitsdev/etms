<?php

namespace App\Livewire\Equipment;

use Filament\Tables;
use Livewire\Component;
use App\Models\Equipment;
use Filament\Tables\Table;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Grouping\Group;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListEquipmentView extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Equipment::query()->latest())
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->searchable(),
            Tables\Columns\TextColumn::make('serial_number')
                ->searchable(isIndividual : true),
            Tables\Columns\TextColumn::make('stock')
                ->numeric()
                ->sortable(),
            Tables\Columns\TextColumn::make('status')
            ->badge()
            ->color(fn (string $state): string => match ($state) {
                'Available' => 'success',
                'Reserved' => 'warning',
                'Not Available' => 'danger',
                'Out of Stock' => 'gray',
                'Archived' => 'info',
                default=> 'gray'
            }),


            Tables\Columns\TextColumn::make('location')
                ->wrap(),
            Tables\Columns\TextColumn::make('issue_description')
            ->label('Issue')
                ->wrap()->formatStateUsing(function (Model $record) {
                    return $record->status == Equipment::UNDER_MAINTENANCE ? $record->issue_description : '';
                }),
            Tables\Columns\TextColumn::make('archived_date')
                ->dateTime()
                ->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('View')
                        ->icon('heroicon-s-eye')
                        ->modalSubmitAction(false)
                        ->modalContent(function (Model $record) {
                            return view('livewire.view-equipment', ['record' => $record]);
                        })
                        ->modalCancelAction(fn(StaticAction $action) => $action->label('Close'))
                        ->closeModalByClickingAway(false)->modalWidth('7xl'),])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ])->groups([
                Group::make('status')
                ->titlePrefixedWithLabel(false),

            ])->defaultGroup('status');
    }

    public function render(): View
    {
        return view('livewire.equipment.list-equipment-view');
    }
}

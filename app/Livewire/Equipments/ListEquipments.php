<?php

namespace App\Livewire\Equipments;

use Filament\Tables;
use Livewire\Component;
use App\Models\Equipment;
use Filament\Tables\Table;
use App\Models\MaintenanceLog;
use App\Exports\EquipmentExport;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Grouping\Group;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListEquipments extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Equipment::query())
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('serial_number')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Available' => 'success',
                        'Reserved' => 'warning',
                        'Not Available' => 'danger',
                        'Out of Stock' => 'gray',
                        'Archived' => 'info',
                        default => 'gray'
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
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])


            ->headerActions([


                Action::make('create')

                    ->color('primary')
                    ->button()
                    ->url(function () {
                        return route('equipment.create');
                    }),







            ])
            ->filters([

            ],
            // layout: FiltersLayout::AboveContent
            )
            ->actions([
                ActionGroup::make([
                    Action::make('View')
                        ->icon('heroicon-s-eye')
                        ->modalSubmitAction(false)
                        ->modalContent(function (Model $record) {
                            return view('livewire.view-equipment', ['record' => $record]);
                        })
                        ->modalCancelAction(fn(StaticAction $action) => $action->label('Close'))
                        ->closeModalByClickingAway(false)->modalWidth('7xl'),

                    Action::make('manage')
                        ->label('Manage')
                        ->icon('heroicon-s-pencil-square')
                        ->modalWidth(MaxWidth::SixExtraLarge)
                        ->fillForm(function (Model $record) {

                            if($record->status == Equipment::UNDER_MAINTENANCE){
                                return [
                                    'status' => $record->status,
                                    'issue_description' => $record->issue_description,
                                ];

                            }else{

                                return [
                                    'status' => $record->status,
                                ];
                            }
                        })
                        ->form(FilamentForm::manageEquipment())

                        ->action(function (Model $record, array $data) {

                            $record->status = $data['status'];
                            if ($data['status'] === Equipment::UNDER_MAINTENANCE) {
                                $record->issue_description = $data['issue_description'];

                            }
                            if ($data['status'] === Equipment::ARCHIVED) {
                                $record->archived_date = now();
                            }
                            $record->reported_by = Auth::user()->id;
                            $record->save();

                            if ($data['status'] === Equipment::UNDER_MAINTENANCE) {
                                MaintenanceLog::create([
                                    'equipment_id' => $record->id,
                                    'issue_description' => $data['issue_description'],
                                    'status' => MaintenanceLog::UNDER_MAINTENANCE,
                                    'reported_by' => Auth::id(),
                                    'reported_date' => now(),
                                ]);
                            }

                            FilamentForm::success('Equipment was' . $data['status']);
                        })->color('gray'),

                    Action::make('Download')

                        ->action(function (Model $record) {



                            // Generate a dynamic filename
                            $createdDate = $record->created_at
                                ? $record->created_at->format('F j, Y')
                                : 'Unknown_Date';
                            $filename = $record->name . '_' . $record->serial_number . '_Created_' . $createdDate . '.xlsx';

                            return Excel::download(new EquipmentExport($record), $filename);
                        })


                        ->icon('heroicon-o-arrow-down-tray')
                        ->requiresConfirmation()
                        ->modalHeading('Export Winners')
                        ->modalSubheading('Download the winners of the event as an Excel report for your reference.')
                        ->modalButton('Download Report'),
                    Tables\Actions\Action::make('Edit')->icon('heroicon-s-pencil-square')->url(function (Model $record) {
                        return route('equipment.edit', ['record' => $record]);
                    })->color('gray'),

                    Tables\Actions\DeleteAction::make()->color('gray'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->groups([
                Group::make('status')
                    ->titlePrefixedWithLabel(false),

            ])->defaultGroup('status');
    }

    public function render(): View
    {
        return view('livewire.equipments.list-equipments');
    }
}

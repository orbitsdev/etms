<?php

namespace App\Livewire\Requests;

use Filament\Tables;
use App\Models\Request;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListRequesterRequest extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Request::query())
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('request_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('actual_return_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pickup_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('return_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user_name_snapshot')
                    ->searchable(),
                Tables\Columns\TextColumn::make('equipment_name_snapshot')
                    ->searchable(),
                Tables\Columns\TextColumn::make('equipment_serial_snapshot')
                    ->searchable(),
                Tables\Columns\TextColumn::make('equipment_department')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([


                Action::make('create')
                ->label('New Request')
                ->color('primary')
                ->button()
                ->url(function(){
                    return route('requests.create');
                }),







            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('View')
                    ->icon('heroicon-s-eye')
                    ->modalSubmitAction(false)
                    ->modalContent(function(Model $record){
                        return view('livewire.view-requester-request', ['record'=> $record]);
                    })
                    ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
                    ->closeModalByClickingAway(false)->modalWidth('7xl'),

                    Tables\Actions\Action::make('Edit')->icon('heroicon-s-pencil-square')->url(function(Model $record){
                        return route('equipment.edit', ['record'=> $record]);})->color('gray'),

                    Tables\Actions\DeleteAction::make()->color('gray'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.requests.list-requester-request');
    }
}

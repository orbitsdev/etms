<?php

namespace App\Livewire\Requests;

use Filament\Tables;
use App\Models\Request;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Grouping\Group;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
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
            ->query(Request::query()->latest())
            ->columns([
                Tables\Columns\TextColumn::make('user.userDetails.fullName')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereHas('user.userDetails', function ($query) use ($search) {
                            $query->where('first_name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%");
                        });
                    })->label('Request By'),
                TextColumn::make('items.equipment.name')
                    ->listWithLineBreaks()->label('Items'),
                Tables\Columns\TextColumn::make('request_date')
                    ->date(),
                Tables\Columns\TextColumn::make('actual_return_date')
                    ->date(),
                Tables\Columns\TextColumn::make('pickup_date')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('return_date')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Pending' => 'gray',
                        'Approved' => 'success',
                        'Ready for Pickup' => 'warning',
                        'Picked Up' => 'success',
                        'Delivered' => 'success',
                        'Returned' => 'success',
                        'Cancelled' => 'danger',
                        'Completed' => 'success',
                    }),

                Tables\Columns\TextColumn::make('status_reason')->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Update')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([


                Action::make('create')
                    ->label('New Request')
                    ->color('primary')
                    ->button()
                    ->url(function () {
                        return route('requests.create');
                    }),







            ])
            ->filters([
                SelectFilter::make('status')
                ->options(Request::STATUS_OPTIONS)->searchable()->multiple()
            ], 
            // layout: FiltersLayout::AboveContentCollapsible
            
            )
            ->actions([
                ActionGroup::make([
                    Action::make('View')
                        ->icon('heroicon-s-eye')
                        ->modalSubmitAction(false)
                        ->modalContent(function (Model $record) {
                            return view('livewire.view-requester-request', ['record' => $record]);
                        })
                        ->modalCancelAction(fn(StaticAction $action) => $action->label('Close'))
                        ->closeModalByClickingAway(false)->modalWidth('7xl'),

                    Tables\Actions\Action::make('Edit')->icon('heroicon-s-pencil-square')->url(function (Model $record) {
                        return route('requests.edit', ['record' => $record]);
                    })->color('gray')
                    ->hidden(function(Model $record){
                        return $record->status != Request::PENDING;
                    }),

                    Tables\Actions\DeleteAction::make()->color('gray'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])  ->groups([
                Group::make('status')
                ->titlePrefixedWithLabel(false),

            ])->defaultGroup('status');
    }

    public function render(): View
    {
        return view('livewire.requests.list-requester-request');
    }
}

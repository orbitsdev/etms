<?php

namespace App\Livewire\JobOrders;

use Filament\Tables;
use Livewire\Component;
use App\Models\JobOrder;
use App\Models\Equipment;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListOfMyJobOrdersRequests extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(JobOrder::query()->myOrders())
            ->columns([
                Tables\Columns\TextColumn::make('user.userDetails.fullName')
                ->label('Name')
                    ->numeric()
                    ->sortable(),
                    Tables\Columns\TextColumn::make('title')
                        ->searchable(),
                    Tables\Columns\TextColumn::make('description')->label('Problem Description')
                        ->searchable()->wrap(),
                // Tables\Columns\TextColumn::make('assignee_id')
                //     ->numeric()
                //     ->sortable(),

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
                Tables\Columns\TextColumn::make('assignee_name')
                ->label('Assigned To')
                ->searchable(),

                Tables\Columns\TextColumn::make('status_reason')->toggleable(isToggledHiddenByDefault: true),
            ])

            ->headerActions([


                Action::make('New Requests')

                    ->color('primary')
                    ->button()
                    ->url(function () {
                        return route('joborders.create');
                    }),


            ])
            ->filters([
                SelectFilter::make('status')
                ->options(JobOrder::STATUSES)->searchable()->multiple()
            ])
            ->actions([
                ActionGroup::make([
                 
                    Tables\Actions\Action::make('Edit')->icon('heroicon-s-pencil-square')->url(function (Model $record) {
                        return route('joborders.edit', ['record' => $record]);
                    })->color('gray')->hidden(function(Model $record){
                    return $record->status != JobOrder::STATUS_PENDING;
                    }),


                    Tables\Actions\DeleteAction::make()->color('gray')->hidden(function(Model $record){
                    return $record->status != JobOrder::STATUS_PENDING;
                    }),
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
        return view('livewire.job-orders.list-of-my-job-orders-requests');
    }
}

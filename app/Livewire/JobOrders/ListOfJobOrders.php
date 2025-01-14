<?php

namespace App\Livewire\JobOrders;

use Filament\Tables;
use Livewire\Component;
use App\Models\JobOrder;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListOfJobOrders extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(JobOrder::query())
            ->columns([
                Tables\Columns\TextColumn::make('user.userDetails.fullName')
                ->label('Name')
                    ->numeric()
                    ->sortable(),
                    Tables\Columns\TextColumn::make('title')
                        ->searchable(),
                    Tables\Columns\TextColumn::make('description')
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

                Tables\Columns\TextColumn::make('status_reason')
                ->label('Reject Reason')
                ->searchable() ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->headerActions([
                Tables\Actions\CreateAction::make('Add Job Order')->form(FilamentForm::JobOrderAdminform())
                    ->mutateFormDataUsing(function (array $data): array {
                        // $data['created_by_id'] = auth()->id();

                        return $data;
                    })->label('Add Job Order')
            ])
            ->filters([
                SelectFilter::make('status')
                ->options(JobOrder::STATUSES)->searchable()->multiple()
            ])
            ->actions([
                ActionGroup::make([

                    Tables\Actions\EditAction::make('Manage')->form(FilamentForm::manageJobOrderForm())
                    
                    ->mutateFormDataUsing(function (array $data): array {
                        // $data['last_edited_by_id'] = auth()->id();

                        return $data;
                    })->label('Manage')
                    ,
                    Tables\Actions\EditAction::make('Update')->form(FilamentForm::JobOrderAdminform())

                    ->mutateFormDataUsing(function (array $data): array {
                        // $data['last_edited_by_id'] = auth()->id();

                        return $data;
                    })->label('Update')
                    ,
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
        return view('livewire.job-orders.list-of-job-orders');
    }
}

<?php

namespace App\Livewire\Request;

use Filament\Tables;
use App\Models\Request;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Grouping\Group;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FilamentForm;
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

class ListOfEquipmentRequest extends Component implements HasForms, HasTable
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

            Tables\Columns\TextColumn::make('updated_at')
                ->label('Last Update')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                ->options(Request::STATUS_OPTIONS)->searchable()
            ], layout: FiltersLayout::AboveContent)
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

                        Action::make('manage')
                    ->label('Manage')
                    ->icon('heroicon-s-pencil-square')
                    ->modalWidth(MaxWidth::SixExtraLarge)
                    ->fillForm(function (Model $record) {

                        return [
                            'status' => $record->status,
                            'status_reason' => $record->status_reason,
                        ];
                    })
                    ->form(FilamentForm::manageRequestForm())
             
                    ->action(function (Model $record,array $data) {
                        
                           $record->status = $data['status'];
                           if($data['status_reason']){
                                $record->status_reason = $data['status_reason'];
                           }
                           $record->updated_by = Auth::user()->id; 
                           $record->save();
                           FilamentForm::success('Request was'.$data['status']);
                        

                    })->color('gray'),

                    // Tables\Actions\Action::make('Edit')->icon('heroicon-s-pencil-square')->url(function (Model $record) {
                    //     return route('requests.edit', ['record' => $record]);
                    // })->color('gray'),

                        



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
        return view('livewire.request.list-of-equipment-request');
    }
}

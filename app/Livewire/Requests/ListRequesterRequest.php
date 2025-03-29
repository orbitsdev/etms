<?php

namespace App\Livewire\Requests;

use Filament\Tables;
use App\Models\Request;
use Livewire\Component;
use Filament\Tables\Table;
use WireUi\Traits\WireUiActions;
use Filament\Actions\StaticAction;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Actions\Action;
use Filament\Tables\Grouping\Group;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
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
    use WireUiActions;

    public function table(Table $table): Table
    {
        return $table
            ->query(Request::query()->myRequest()->latest())
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


ViewColumn::make('Feedback')->view('tables.columns.request-feedback'),
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
                    Tables\Actions\Action::make('addFeedback')
                    ->label('Submit Feedback') // Button label
                    ->icon('heroicon-s-star')
                    ->size('lg')
                    ->form(FilamentForm::feedBackForm())
                    ->action(function (Model $record,array $data) {
                        $user_id = Auth::id(); // Get the authenticated user ID

                        try {
                            DB::beginTransaction();

                            // Create feedback record
                            $record->feedback()->create([
                                'user_id' => $user_id,
                                'message' => $data['message'],
                                'rating' => $data['rating'],
                            ]);

                            DB::commit();

                            // Show success dialog
                            $this->dialog()->success(
                                'Feedback Submitted',
                                'Thank you for sharing your feedback!'
                            );
                        } catch (\Exception $e) {
                            DB::rollBack();

                            // Show error dialog
                            $this->dialog()->error(
                                'Error',
                                'Failed to submit your feedback. Please try again later.'
                            );
                        }
                    })->visible(function (Model $record) {
                        return in_array($record->status, [Request::COMPLETED, Request::RETURNED])
                            && is_null($record->feedback);
                    }),

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

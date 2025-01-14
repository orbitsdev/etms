<?php

namespace App\Livewire\Users;

use App\Models\User;
use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\UserDetails;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Grouping\Group;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListUsers extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query()->isNotAdmin())
            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('email_verified_at')
                //     ->dateTime()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('two_factor_confirmed_at')
                //     ->dateTime()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('current_team_id')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('profile_photo_path')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('role'),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                    ImageColumn::make('avatar')
                    ->defaultImageUrl(url('/images/placeholder-image.jpg')),

                 TextColumn::make('userDetails.type')
                 ->label('Type')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        UserDetails::FACULTY => 'success',
                        UserDetails::STUDENT => 'info',
                        UserDetails::JOBORDER => 'warning',

                        default => 'gray'
                    }),
            ])
            ->headerActions([
                Action::make('Register')

                ->color('primary')
                ->button()
                ->url(function () {
                    return route('users.create');
                }),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(User::getRoleOptions())->searchable()
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('View')
                    ->icon('heroicon-s-eye')
                    ->modalSubmitAction(false)
                    ->modalContent(function (Model $record) {
                        return view('livewire.view-user-details', ['record' => $record]);
                    })
                    ->modalCancelAction(fn(StaticAction $action) => $action->label('Close'))
                    ->closeModalByClickingAway(false)->modalWidth('7xl'),
                    Tables\Actions\Action::make('Edit')->icon('heroicon-s-pencil-square')->url(function (Model $record) {
                        return route('users.edit', ['record' => $record]);
                    })->color('gray'),

                    Tables\Actions\DeleteAction::make()->color('gray'),

                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])

            ->groups([
                Group::make('userDetails.type')
                    ->titlePrefixedWithLabel(false),

            ])->defaultGroup('userDetails.type')

            ->deferLoading()

            ;
    }

    public function render(): View
    {
        return view('livewire.users.list-users');
    }
}

<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListAdmins extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query()->where('role', User::ADMIN)
                ->whereNotIn('email', [
                    'superadmin@gmail.com', 
                    'admin@gmail.com',
                    'admin@etms.com',
                    'developer@gmail.com'
                ]))
            ->columns([
                ImageColumn::make('Profile')
                    ->defaultImageUrl(url('/images/placeholder-image.jpg')),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime('F j, Y')
                    ->sortable(),
            ])
            ->headerActions([
                Action::make('Create Admin')
                ->color('primary')
                ->button()
                ->url(function () {
                    return route('admins.create');
                }),
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
            ->deferLoading();
    }

    public function render(): View
    {
        return view('livewire.list-admins');
    }
}

<?php

namespace App\Livewire\Courses;

use Filament\Tables;
use App\Models\Course;
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
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListCourse extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Course::query())
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                    TextColumn::make('sections_count')->counts('sections')
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
                ->url(function(){
                    return route('courses.create');
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
                        return view('livewire.view-course', ['record'=> $record]);
                    })
                    ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
                    ->closeModalByClickingAway(false)->modalWidth('7xl')
                    ->hidden(function(Model $record){
                       return !$record->sections()->exists();
                    }),

                    Tables\Actions\Action::make('Edit')->icon('heroicon-s-pencil-square')->url(function(Model $record){
                        return route('courses.edit', ['record'=> $record]);})->color('gray'),

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
        return view('livewire.courses.list-course');
    }
}

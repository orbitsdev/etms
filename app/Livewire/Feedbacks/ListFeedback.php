<?php

namespace App\Livewire\Feedbacks;

use Filament\Tables;
use Livewire\Component;
use App\Models\Feedback;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListFeedback extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Feedback::query())
            ->columns([
                Tables\Columns\TextColumn::make('user.userDetails.fullName')->searchable(query: function (Builder $query, string $search): Builder {
                    return $query->whereHas('user.userDetails', function ($query) use ($search) {
                        $query->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");
                    });
                })
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('message')
                    ->wrap(),
                Tables\Columns\TextColumn::make('rating')
                    ->numeric()
                    ->sortable(),
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
                Tables\Actions\CreateAction::make('Add Feed Back')->form(FilamentForm::feedBackAdminForm())
                    ->mutateFormDataUsing(function (array $data): array {
                        // $data['created_by_id'] = auth()->id();

                        return $data;
                    })->label('New Feedback')
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.feedbacks.list-feedback');
    }
}

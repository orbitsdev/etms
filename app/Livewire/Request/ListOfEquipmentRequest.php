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
use WireUi\Traits\WireUiActions;

class ListOfEquipmentRequest extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;
    use WireUiActions;

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
                Tables\Columns\TextColumn::make('actual_return_date')->label('Expected returned date')
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
            ->filters([
                SelectFilter::make('status')
                    ->options(Request::STATUS_OPTIONS)->searchable()->multiple()
            ],
            // layout: FiltersLayout::AboveContent

            )
            ->actions([
                ActionGroup::make([
                    Action::make('Print')
    ->label('Print Acknowledgement')
    ->icon('heroicon-o-printer')
    ->color('primary')
    ->url(fn (Model $record) => route('report.property-acknowledgement', ['requestId'=> $record->id]))
    ->openUrlInNewTab(),

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

                        ->action(function (Model $record, array $data) {

                            if ($record->status == $data['status']) return;
                            // Fetch all items with their equipment
                            $allItems = $record->items()->with('equipment')->get();

                            // Group items by availability
                            $unavailableItems = $allItems->filter(function ($item) {
                                return $item->equipment && $item->equipment->status !== 'Available';
                            });

                            $availableItems = $allItems->filter(function ($item) {
                                return $item->equipment && $item->equipment->status === 'Available';
                            });

                            // Generate HTML table for items
                            $itemsTable = '<table style="width:100%; border-collapse: collapse;">';
                            $itemsTable .= '<thead><tr>
                                <th style="border: 1px solid #ccc; padding: 8px;">Item Name</th>
                                <th style="border: 1px solid #ccc; padding: 8px;">Quantity</th>
                                <th style="border: 1px solid #ccc; padding: 8px;">Status</th>
                            </tr></thead><tbody>';

                            if ($unavailableItems->isNotEmpty()) {
                                $itemsTable .= '<tr><td colspan="3" style="background-color: #f8d7da; text-align: center; padding: 8px;">Oops! These items are unavailable:</td></tr>';
                                foreach ($unavailableItems as $item) {
                                    $itemsTable .= '<tr>';
                                    $itemsTable .= '<td style="border: 1px solid #ccc; padding: 8px;">' . ($item->equipment->name ?? 'Unknown Item') . '</td>';
                                    $itemsTable .= '<td style="border: 1px solid #ccc; padding: 8px;">' . $item->quantity . '</td>';
                                    $itemsTable .= '<td style="border: 1px solid #ccc; padding: 8px;">' . ($item->equipment->status ?? 'Status Unknown') . '</td>';
                                    $itemsTable .= '</tr>';
                                }
                            }

                            if ($availableItems->isNotEmpty()) {
                                $itemsTable .= '<tr><td colspan="3" style="background-color: #d4edda; text-align: center; padding: 8px;">Good news! These items are ready to go:</td></tr>';
                                foreach ($availableItems as $item) {
                                    $itemsTable .= '<tr>';
                                    $itemsTable .= '<td style="border: 1px solid #ccc; padding: 8px;">' . ($item->equipment->name ?? 'Unknown Item') . '</td>';
                                    $itemsTable .= '<td style="border: 1px solid #ccc; padding: 8px;">' . $item->quantity . '</td>';
                                    $itemsTable .= '<td style="border: 1px solid #ccc; padding: 8px;">' . ($item->equipment->status ?? 'Status Unknown') . '</td>';
                                    $itemsTable .= '</tr>';
                                }
                            }

                            $itemsTable .= '</tbody></table>';

                            // Handle status-specific dialog content based on new status
                            $description = '';
                            switch ($data['status']) {
                                case Request::APPROVED:
                                    $description = "You're about to approve this request. Here's a quick summary:<br><br>" . $itemsTable;
                                    break;

                                case Request::CANCELED:
                                    $description = "Are you sure you want to cancel this request? Here's a look at the items involved:<br><br>" . $itemsTable;
                                    break;

                                case Request::READY_FOR_PICKUP:
                                    $description = "Time to let them know! Mark this request as 'Ready for Pickup'.";
                                    break;

                                case Request::RETURNED:
                                    $description = "Looks like the items are back! Mark this request as 'Returned'.";
                                    break;

                                case Request::COMPLETED:
                                    $description = "All done! Mark this request as 'Completed' and wrap things up.";
                                    break;

                                case Request::PICKUP:
                                    $description = "Ready for the next step? Mark this request as 'Picked Up'.";
                                    break;

                                default:
                                    FilamentForm::danger("Hmm... something's not quite right. This status doesn't seem valid.");
                                    return; // Stop execution
                            }

                            // Show confirmation dialog
                            $this->dialog()->confirm([
                                'title' => "Ready to {$data['status']} this request?",
                                'description' => $description,
                                'icon' => $data['status'] === Request::CANCELED ? 'error' : 'success',
                                'acceptLabel' => 'Yes, let’s do it!',
                                'rejectLabel' => 'Close',
                                'method' => 'confirmAction',
                                'params' => ['record' => $record, 'data' => $data],
                                'onDismiss' => function () {
                                    FilamentForm::danger("Action canceled. No changes were made.");
                                },
                            ]);
                        })
                        ->color('gray')
                        ->hidden(function(Model $record){
                            return $record->status == Request::COMPLETED;
                        })
                        ,


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
            ])->groups([
                Group::make('status')
                    ->titlePrefixedWithLabel(false),

            ])->defaultGroup('status');
    }

    public function render(): View
    {
        return view('livewire.request.list-of-equipment-request');
    }

    public function confirmAction($data)
    {
        $record = Request::findOrFail($data['record']['id']);

        // Update the request status
        $record->status = $data['data']['status'];
        if($data['data']['status'] == Request::CANCELED){
            $record->status_reason = $data['data']['status_reason'] ?? '';
        }
        $record->updated_by = Auth::user()->id;
        $record->save();

        // Handle stock deduction only for APPROVED or READY_FOR_PICKUP statuses
        if (in_array($data['data']['status'], [Request::APPROVED, Request::READY_FOR_PICKUP])) {
            // Fetch all items in the request with their equipment
            $items = $record->items()->with('equipment')->get();

            $insufficientStock = [];
            $updatedSuccessfully = [];

            foreach ($items as $item) {
                $equipment = $item->equipment;

                if ($equipment) {
                    // Check stock availability
                    if ($equipment->stock >= $item->quantity) {
                        $equipment->stock -= $item->quantity;
                        $equipment->save();
                        $updatedSuccessfully[] = $equipment->name; // Track successful updates
                    } else {
                        // Track insufficient stock
                        $insufficientStock[] = [
                            'name' => $equipment->name,
                            'available' => $equipment->stock,
                            'required' => $item->quantity,
                        ];
                    }
                }
            }

            // If there are insufficient stock items, show an error dialog with details
            if (!empty($insufficientStock)) {
                $html = '<div class="text-left">';
                $html .= '<p>The following items have insufficient stock:</p><ul>';
                foreach ($insufficientStock as $item) {
                    $html .= "<li><strong>{$item['name']}</strong>: Available: {$item['available']}, Required: {$item['required']}</li>";
                }
                $html .= '</ul></div>';

                $this->dialog()->confirm([
                    'title' => 'Insufficient Stock!',
                    'description' => $html,
                    'icon' => 'error',
                    'acceptLabel' => 'Close', // Text for the button
                    'method' => null, // No further action
                ]);


                return; // Stop further execution if stock is insufficient
            }

            // If all items are updated successfully, show a success dialog
            if (!empty($updatedSuccessfully)) {
                $successItems = implode(', ', $updatedSuccessfully);


                $this->dialog()->show([
                    'icon' => 'success',
                'title' => "The stock for the following items has been updated successfully: <strong>{$successItems}</strong>.",
                    'description' => 'This is a description.',
                ]);
            }

            return; // Stop here if stock was updated successfully
        }

        FilamentForm::success('The request has been updated successfully.');
        // Show a success dialog for status updates that don’t involve stock
        // $this->dialog()->confirm([
        //     'title' => 'Request Updated!',
        //     'description' => 'The request has been updated successfully.',
        //     'icon' => 'success',
        //     'acceptLabel' => 'Close',
        //     'method' => null, // No further action
        // ]);
    }

}




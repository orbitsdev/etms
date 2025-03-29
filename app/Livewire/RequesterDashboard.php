<?php

namespace App\Livewire;

use App\Models\Request;
use Livewire\Component;
use App\Models\Feedback;
use App\Models\JobOrder;
use Filament\Actions\Action;
use Livewire\WithPagination;
use WireUi\Traits\WireUiActions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class RequesterDashboard extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;
    use WireUiActions;
    use WithPagination;
    public $canSubmitFeedback = false;

    public function mount()
    {
        $this->checkFeedbackEligibility();
    }
    public function render()
    {
        // Fetch feedback data with related user and userDetails
        $feedbacks = Feedback::with('user.userDetails') // Load related user and userDetails
            ->latest() // Order by the latest
            ->paginate(6); // Paginate with 6 items per page

        return view('livewire.requester-dashboard', [
            'feedbacks' => $feedbacks,
        ]);
    }


    public function checkFeedbackEligibility()
    {
        $userId = Auth::id();
        $hasCompletedRequest = Request::where('user_id', $userId)
            ->where('status', Request::RETURNED)
            ->orWhere('status', Request::COMPLETED)
            ->exists();

        $hasCompletedJobOrder = JobOrder::where('requester_id', $userId)
            ->where('status', JobOrder::STATUS_COMPLETED)
            ->exists();


        // Update the eligibility flag
        $this->canSubmitFeedback = $hasCompletedRequest || $hasCompletedJobOrder;
    }
    public function addFeedbackAction(): Action
    {
        return Action::make('addFeedback')
            ->label('Submit Feedback') // Button label
            ->icon('heroicon-s-star')
            ->size('lg')
            ->form(FilamentForm::feedBackForm())
            ->action(function (array $data) {
                $user_id = Auth::id(); // Get the authenticated user ID

                try {
                    DB::beginTransaction();

                    // Create feedback record
                    Feedback::create([
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
            });
    }
}

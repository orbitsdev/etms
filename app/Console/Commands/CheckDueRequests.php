<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Request;
use Illuminate\Console\Command;

class CheckDueRequests extends Command
{


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-due-requests';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check overdue requests and notify users.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
//         // Get all requests that should be marked as DUE
//        // Get all requests that should be marked as DUE
//        $dueRequests = Request::whereNotIn('status', [Request::PENDING, Request::COMPLETED, Request::RETURNED])
//        ->where('return_date', '<', Carbon::now()) // Check if return date is past
//        ->get();

//    foreach ($dueRequests as $request) {
//        $request->update(['status' => Request::DUE]);

//        // Send an email notification
//        if ($request->user) {
//            Mail::to($request->user->email)->send(new RequestDueReminder($request));
//        }

//        $this->info("Marked request ID {$request->id} as DUE and sent notification.");
//    }

//    Log::info("Due requests checked and notifications sent.");

    }
}

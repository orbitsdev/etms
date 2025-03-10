<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Request;
use Illuminate\Console\Command;
use App\Mail\RequestDueReminder;
use Illuminate\Support\Facades\Mail;

class UpdateDueStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-due-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $now = Carbon::now();

        // Find requests with status 'Picked Up' and past their return date
        $requests = Request::where('status', Request::PICKUP)
            ->whereNotNull('return_date')
            ->where('return_date', '<', $now)
            ->get();

        foreach ($requests as $request) {
            $request->status = Request::DUE;
            $request->save();

            if ($request->user) {
                Mail::to($request->user->email)->send(new RequestDueReminder($request));
            }

            $this->info("Request ID {$request->id} status updated to Due.");
        }

        $this->info('Status update complete.');
    }
}

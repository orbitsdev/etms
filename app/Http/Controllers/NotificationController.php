<?php

namespace App\Http\Controllers;

use App\Models\JobOrder;
use App\Mail\RequestUpdate;
use App\Mail\JobOrderUpdate;
use Illuminate\Http\Request;
use App\Models\Request as Rmodel;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{
    public static function send(Rmodel $record,){
        try {
            Mail::to($record->user->email)->send(new RequestUpdate($record));

            // Log or perform an action indicating the email was sent
            \Log::info("Email sent to {$record->user->email} for Request ID: {$record->id}");
        } catch (\Exception $e) {
            // Handle errors during email sending
            \Log::error("Failed to send email to {$record->user->email}: " . $e->getMessage());
        }
    }


    public static function sendJobOrderNotification(JobOrder $jobOrder): void
    {
        try {
            // Send an email notification to the requester
            Mail::to($jobOrder->user->email)->send(new JobOrderUpdate($jobOrder));

            // Log the successful notification
            \Log::info("Email sent to {$jobOrder->user->email} for Job Order ID: {$jobOrder->id}");
        } catch (\Exception $e) {
            // Log the error in case of failure
            \Log::error("Failed to send email to {$jobOrder->user->email}: " . $e->getMessage());
        }
    }
}

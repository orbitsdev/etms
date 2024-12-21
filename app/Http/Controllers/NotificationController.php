<?php

namespace App\Http\Controllers;

use App\Mail\RequestUpdate;
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
}

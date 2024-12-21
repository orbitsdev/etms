<?php

namespace App\Http\Controllers;

use App\Mail\RequestUpdate;
use Illuminate\Http\Request;
use App\Models\Request as Rmodel;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{
    public static function send(Rmodel $record,){
        Mail::to($record->user->email)->send(mailable: new RequestUpdate($record,));
    }
}

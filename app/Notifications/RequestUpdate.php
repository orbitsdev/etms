<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\SerializesModels;
class RequestUpdate extends Notification
{
    use Queueable, SerializesModels;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Request $request)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Request Update Notification')
                    ->greeting('Hello ' . $this->request->user->name . ',')
                    ->line('Your request status has been updated to: ' . $this->request->status . '.')
                    ->line('Purpose: ' . $this->request->purpose)
                    ->line('Reason: ' . ($this->request->status_reason ?? 'N/A'))
                    ->line('Updated by: ' . ($this->request->updated_by ? $this->request->updatedBy->name : 'System'))
                    ->line('Thank you for using our application!')
                    ->action('View Request', url('/requests/' . $this->request->id));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'request_id' => $this->request->id,
            'status' => $this->request->status,
            'updated_by' => $this->request->updated_by,
        ];
    }
}

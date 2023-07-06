<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewNoteUploadedNotification extends Notification
{
    use Queueable;
    protected $faculty_name;
    protected $noti_name;
    protected $file_name;

    /**
     * Create a new notification instance.
     */
    public function __construct($faculty_name,$noti_name, $file_name)
    {
        $this->faculty_name = $faculty_name;
        $this->noti_name = $noti_name;
        $this->file_name = $file_name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('New note')
                    ->line($this->faculty_name. ' uploaded new note' .''. $this->file_name);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'data' => $this->faculty_name. ' uploaded new ' .$this->noti_name. ' ' . $this->file_name
        ];
    }
}

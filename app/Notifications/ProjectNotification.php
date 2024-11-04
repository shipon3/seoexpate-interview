<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $project;
    protected $subject;
    /**
     * Create a new notification instance.
     */
    public function __construct($project,$subject)
    {
        $this->project = $project;
        $this->subject = $subject;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject($this->subject) // Email subject
        ->view('emails.project_create', ['project' => $this->project]) // Custom view
        ->line('Thanks for new Project!')
        ->line('We appreciate your business.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->subject,
            'description' => 'You have new notify',
            'icon' => 'bx-file',
            'project_id' => $this->project->id,
            'user_name' => $this->project->user->name,
        ];
    }
}

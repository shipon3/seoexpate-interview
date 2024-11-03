<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $project;
    /**
     * Create a new notification instance.
     */
    public function __construct($project)
    {
        $this->project = $project;
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
        ->subject('Project Status Change') // Email subject
        ->view('emails.project_create', ['project' => $this->project]) // Custom view
        ->line('Thanks for update project status!')
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
            'title' => 'Project Status Update',
            'description' => 'Change Project Status',
            'icon' => 'bx-cart-alt',
            'project_id' => $this->project->id,
            'user_name' => $this->project->user->name,
        ];
    }
}

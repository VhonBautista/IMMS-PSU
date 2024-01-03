<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SystemNotification extends Notification
{
    use Queueable;

    public function __construct($title, $action, $description, $route)
    {
        $this->title = $title;
        $this->action = $action;
        $this->description = $description;
        $this->route = $route;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->title,
            'action' => $this->action,
            'description' => $this->description,
            'route' => $this->route,
        ];
    }
}

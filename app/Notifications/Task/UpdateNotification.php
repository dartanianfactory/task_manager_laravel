<?php

namespace App\Notifications\Task;

use App\Models\Project\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $task;

    public function __construct(Task $task = null)
    {
        $this->task = $task;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Задача обновлена!' . $this->task->id . 'Название: ' . $this->task->header);
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

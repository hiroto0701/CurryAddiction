<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LikeNotification extends Notification
{
    use Queueable;

    protected $post;
    protected $user;


    /**
     * Create a new notification instance.
     */
    public function __construct($post, $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'notified_target' => [
                'post_id' => $this->post->id,
                'slug' => $this->post->slug,
                'store_name' => $this->post->store_name,
            ],
            'notified_from_user' => [
                'user_id' => $this->user->user_id,
                'handle_name' => $this->user->handle_name,
                'display_name' => $this->user->display_name,
                'avatar_url' => $this->user->avatar ? $this->user->avatar->url : null,
            ],
        ];
    }
}

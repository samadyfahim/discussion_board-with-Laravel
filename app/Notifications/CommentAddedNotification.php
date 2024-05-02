<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Comment;
use App\Models\User;

class CommentAddedNotification extends Notification
{
    use Queueable;

    protected $comment;
    protected $postCreatedBy;

    /**
     * Create a new notification instance.
     */
    public function __construct(Comment $comment, User $postCreatedBy)
    {
        $this->comment = $comment;
        $this->postCreatedBy = $postCreatedBy;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {

        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Just notifying you a new comment has been added to your post.')
            ->action('To view the comment', url('/profile/' . $this->postCreatedBy->id))
            ->line('Thank you for using what is up?');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'just notefy you a new comment has been added to your post.' . $this->comment->content,
            'post_id' => $this->comment->post_id
        ];
    }
}

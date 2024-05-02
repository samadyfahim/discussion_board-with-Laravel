<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Events\CommentAdded;
use App\Notifications\CommentAddedNotification;

class AddComment extends Component
{

    public $post;
    public $content;
    public function mount(Post $post)
    {
        $this->post = $post;
    }

    protected $rules = [
        'content' => 'required|string|max:255',
    ];

    public function addComment()
    {
        logger('Current content: ', ['content' => $this->content]);
        $this->validate();
        $userId = Auth::id();

        $comment = new Comment;
        $comment->post_id = $this->post->id;
        $comment->user_id = $userId;
        $comment->content = $this->content;
        $comment->save();

        // using service provider even when commnet added
        // event(new CommentAdded($comment));

        $this->dispatch('commentAdded');

        $postCreatedBy = $this->post->user;
        logger('postCreatedBy is: ', ['postCreatedBy' => $postCreatedBy]);

        if ($postCreatedBy) {
            $postCreatedBy->notify(new CommentAddedNotification($comment, $postCreatedBy));
        }

        $this->content = '';
        $this->reset('content');
    }
    public function render()
    {
        return view('livewire.add-comment');
    }
}

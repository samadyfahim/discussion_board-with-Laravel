<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


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


        $this->content = '';

        return redirect()->route('dashboard');
    }
}

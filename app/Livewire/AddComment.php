<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Events\CommentAdded;
use Livewire\WithFileUploads;
use App\Notifications\CommentAddedNotification;
use App\Models\Image;

class AddComment extends Component
{
    use WithFileUploads;
    public $post;
    public $content;
    public $image;
    public function mount(Post $post)
    {
        $this->post = $post;
    }

    protected $rules = [
        'content' => 'required|string|max:255',
        'image' => 'nullable|image|max:1024',
    ];

    public function addComment()
    {
        $this->validate();
        $userId = Auth::id();
        $comment = new Comment;
        $comment->post_id = $this->post->id;
        $comment->user_id = $userId;
        $comment->content = $this->content;
        $comment->save();

        if ($this->image) {
            $imagePath = $this->image->store('images', 'public');
            $image = new Image();
            $image->imagePath = $imagePath;
            $image->imageable()->associate($comment);
            $image->save();
        }
        $this->content = '';
        $this->image = null;
        $this->reset(['content', 'image']);


        // using service provider even when commnet added
        event(new CommentAdded($comment));

        $this->dispatch('commentAdded');

        $postCreatedBy = $this->post->user;
        logger('postCreatedBy is: ', ['postCreatedBy' => $postCreatedBy]);

        if ($postCreatedBy) {
            $postCreatedBy->notify(new CommentAddedNotification($comment, $postCreatedBy));
        }
    }
    public function render()
    {
        return view('livewire.add-comment');
    }
}

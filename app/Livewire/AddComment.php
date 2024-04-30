<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Post;

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
        $this->validate();
        Comment::create([
            'post_id' => $this->post->id,
            'content' => $this->content,
        ]);
        $this->content = '';
        $this->emit('commentAdded');
    }

    public function render()
    {
        return view('livewire.add-comment');
    }
}

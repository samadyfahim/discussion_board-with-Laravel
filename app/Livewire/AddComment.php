<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Post;

class AddComment extends Component
{
    public $post;
    public $content;

    protected $rules = [
        'content' => 'required|string|min:3',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addComment()
    {
        $validatedData = $this->validate();

        Comment::create([
            'post_id' => $this->post->id,
            'content' => $validatedData['content'],
        ]);

        $this->content = '';
        $this->emit('commentAdded');
    }


    public function render()
    {
        return view('livewire.add-comment');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;

class AddPostForm extends Component
{
    use WithFileUploads;

    public $title;
    public $content;
    public $image;

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'image' => 'image|max:1024',
    ];

    public function savePost()
    {
        $this->validate();

        if ($this->image) {
            $imagePath = $this->image->store('images', 'public');
            $postData['image'] = $imagePath;
        }

        // Create the post
        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'image' => $imagePath ?? null,
        ]);

        session()->flash('message', 'Post created successfully.');

        $this->reset(['title', 'content', 'image']);
    }
    public function render()
    {
        return view('livewire.add-post-form');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

    public function post()
    {
        $this->validate();

        $imagePath = null;

        if ($this->image) {
            $imagePath = $this->image->store('images', 'public');
        }

        $userId = Auth::id();

        $post = new Post();
        $post->title = $this->title;
        $post->content = $this->content;
        $post->image = $imagePath;
        $post->user_id = $userId;

        $post->save();

        session()->flash('message', 'Post created successfully.');

        $this->reset(['title', 'content', 'image']);

        return redirect()->route('dashboard');
    }
    public function render()
    {
        return view('livewire.add-post-form')->layout('layouts.app');
    }
}

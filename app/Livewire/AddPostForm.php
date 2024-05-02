<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Image;

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


        $userId = Auth::id();

        $post = new Post();
        $post->title = $this->title;
        $post->content = $this->content;
        $post->user_id = $userId;

        $post->save();

        if ($this->image) {
            $imagePath = $this->image->store('images', 'public');

            $image = new Image();
            $image->imagePath = $imagePath;
            $image->imageable()->associate($post);
            $image->save();
        }

        session()->flash('message', 'Post created successfully.');

        $this->reset(['title', 'content', 'image']);

        return redirect()->route('dashboard');
    }
    public function render()
    {
        return view('livewire.add-post-form')->layout('layouts.app');
    }
}

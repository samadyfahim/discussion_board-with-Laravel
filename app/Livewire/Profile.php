<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $showModal = false;
    public $post;
    public $postId;
    public $title;
    public $content;
    public $image;
    public $userId;
    public $posts;

    public function mount($id)
    {
        $this->userId = $id;
        $this->loadPosts();
    }
    public function loadPosts()
    {
        $this->posts = Post::where('user_id', $this->userId)->latest()->get();
    }

    public function toggleModal()
    {
        Log::info('toggleModal method called');
        $this->showModal = !$this->showModal;
    }

    public function loadPost($postId)
    {
        $this->post = Post::findOrFail($postId);
        $this->postId = $this->post->id;
        $this->title = $this->post->title;
        $this->content = $this->post->content;
        $this->image = $this->post->imagePath;
        $this->toggleModal();
    }


    public function save()
    {
        Log::info('save method called with post ID: ' . $this->postId);
        $this->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'file|image|max:1024'

        ]);
        Log::info('save pass validation method called');

        $post = Post::find($this->postId);
        Log::info('post find');

        if ($post) {
            Log::info($post->title);
            $post->title = $this->title;
            $post->content = $this->content;
            if ($this->image) {
                $imagePath = $this->image->store('images', 'public');

                $image = $post->imagePath ?: new Image();
                $image->imagePath = $imagePath;
                $image->imageable_id = $post->id;
                $image->imageable_type = get_class($post);
                $image->save();
            }
            $post->save();
            Log::info('saved');
            $this->showModal = false;
            session()->flash('message', 'Post updated successfully.');
            $this->resetInputFields();
        } else {
            session()->flash('error', 'Post not found.');
        }
    }


    public function resetInputFields()
    {
        $this->title = '';
        $this->content = '';
        $this->image = null;
    }


    public function closeModal()
    {
        Log::info('closeModal method called');
        $this->showModal = false;
    }

    public function deletePost($postId)
    {
        $post = Post::find($postId);
        if ($post) {
            $post->delete();
            session()->flash('message', 'Post deleted successfully.');
        } else {
            session()->flash('error', 'Post not found.');
        }
    }

    public function render()
    {
        $user = User::findOrFail($this->userId);
        Log::info($this->userId);
        $posts = $user->posts()->latest()->paginate(10);
        Log::info($posts);
        return view('livewire.profile', ['user' => $user, 'posts' => $posts])
            ->layout('layouts.app');
    }
}

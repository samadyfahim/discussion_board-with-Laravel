<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
use App\Models\Image;

class ViewPosts extends Component
{
    use WithFileUploads;
    public $showModal = false;
    public $post;
    public $postId;
    public $title;
    public $content;
    public $image;

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
        $this->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'image|max:1024'
        ]);

        $post = Post::find($this->postId);

        if ($post) {
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
        $posts = Post::latest()->paginate(10);
        return view('livewire.view-posts', ['posts' => $posts]);
    }
}

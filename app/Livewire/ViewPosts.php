<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;


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
        $this->image = $this->post->image;
        $this->toggleModal();
    }


    public function save()
    {
        Log::info('save method called with post ID: ' . $this->postId);
        $this->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            // 'image' => 'sometimes|file|image|max:5000', // Un-comment and adjust if image handling is needed
        ]);
        Log::info('save pass validation method called');

        Log::info($this->title);


        $post = Post::find($this->postId);
        Log::info('post find');




        if ($post) {
            Log::info($post);

            Log::info($post->title);
            $post->title = $this->title;
            $post->content = $this->content;
            if ($this->image) {
                $post->image = $this->image->store('images', 'public');
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
        Log::info('render method called');
        $posts = Post::latest()->paginate(10);
        return view('livewire.view-posts', ['posts' => $posts]);
    }
}

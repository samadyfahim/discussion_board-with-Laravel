<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class ViewPosts extends Component
{
    public function render()
    {
        $posts = Post::latest()->paginate(10);
        return view('livewire.view-posts', ['posts' => $posts]);
    }
}

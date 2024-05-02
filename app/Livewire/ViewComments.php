<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Models\Post;

class ViewComments extends Component
{
    public $showComments = false;
    public $post;
    public $hasComments = false;
    public $showModal = false;
    public $content;
    public $commentId;


    protected $listeners = [
        'commentAdded' => 'refreshComments'
    ];

    public function refreshComments()
    {
        $this->post->load('comments');
    }


    protected $rules = [
        'content' => 'required|string',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->hasComments = $this->post->comments()->exists();
    }

    public function toggleComments()
    {
        $this->showComments = !$this->showComments;
    }

    public function toggleModal()
    {
        Log::info('toggleModal method called');
        $this->showModal = !$this->showModal;
    }

    public function loadComment($commentId)
    {
        $this->commentId = $commentId;
        $comment = $this->post->comments->find($commentId);
        if ($comment) {
            $this->content = $comment->content;
            $this->toggleModal();
        }
    }

    public function closeModal()
    {
        Log::info('closeModal method called');
        $this->showModal = false;
    }

    public function save()
    {
        $this->validate();
        $comment = $this->post->comments->find($this->commentId);
        if ($comment) {
            $comment->content = $this->content;
            $comment->save();
            $this->showModal = false;
            session()->flash('message', 'Comment updated successfully.');
        } else {
            session()->flash('error', 'Comment not found.');
        }
    }

    public function deleteComment($commentId)
    {
        $comment = $this->post->comments->find($commentId);
        if ($comment) {
            $comment->delete();
            session()->flash('message', 'Comment deleted successfully.');
        } else {
            session()->flash('error', 'Comment not found.');
        }
    }

    public function render()
    {
        return view('livewire.view-comments', [
            'comments' => $this->showComments ? $this->post->comments : []
        ]);
    }
}

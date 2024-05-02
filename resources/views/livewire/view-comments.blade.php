<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    @if($hasComments)
    <div class="flex justify-between items-center">
        <button type="button" wire:click="toggleComments" class="ml-0 mr-10">
            View Comments
        </button>
        <p>Number of comments: {{ $post->comments->count() }}</p>
    </div>

    @if($showComments)
    <div>
        @foreach($comments as $comment)
        <div class="flex justify-between items-center">
            <div>
                <span class="font-semibold text-gray-900">{{ $comment->user->name }}</span>
                <span>: {{ $comment->content }}</span>
            </div>
            @if(Auth::id() === $comment->user_id)
            <div x-data="{ open: false }">
                <button @click="open = !open" class="p-2 focus:outline-none focus:shadow-outline">
                    <svg class="h-6 w-6 fill-current text-gray-600 hover:text-gray-700"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512">
                        <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path
                            d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z" />
                    </svg>
                </button>
                <div x-show="open" @click.away="open = false"
                    class="mt-2 py-2 w-40 bg-white rounded-lg shadow-xl absolute right-5 ml-[-4px]">
                    <button wire:click="loadComment({{ $comment->id }})"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                        Edit
                    </button>
                    <button wire:click.prevent="deleteComment({{ $comment->id }})"
                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Delete</button>
                </div>
            </div>
            @endif
        </div>
        <div>
            @foreach($comment->images as $image)
            <img src="{{ asset('storage/' . $image->imagePath) }}" class="w-20 h-20" alt="{{ $comment->title }}">
            @endforeach
        </div>
        @endforeach
    </div>
    @endif
    @endif

    @if($showModal)
    <div class="fixed inset-1 flex items-center justify-center">
        <div class="bg-white p-6">
            <textarea wire:model="content" class="w-full border rounded px-3 py-2 text-gray-700"></textarea>
            <div class="flex justify-between">
                <button wire:click="save"
                    class=" justify-between bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded">
                    Save Changes
                </button>
                <button wire:click="closeModal"
                    class="ml- 10 bg-red-400 hover:bg-red-900 text-white font-bold py-3 px-4 rounded">
                    Close
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
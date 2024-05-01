<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    @if($hasComments)
    <div class="flex justify-between items-center">
        <button 
            type="button" 
            wire:click="toggleComments"
            class="ml-0 mr-10">
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
                    <div x-data="{ open: false }">
                        <button @click="open = !open" class="p-2 focus:outline-none focus:shadow-outline">
                            <svg class="h-6 w-6 fill-current text-gray-600 hover:text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4zm0-10a2 2 0 100 4 2 2 0 000-4zm0 18a2 2 0 100-4 2 2 0 000 4z"/></svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="mt-2 py-2 w-48 bg-white rounded-lg shadow-xl">
                            <button wire:click="loadComment({{ $comment->id }})" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                                Edit 
                            </button>
                            <button wire:click.prevent="deleteComment({{ $comment->id }})" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Delete</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    @endif
    @if($showModal)
        <div class="fixed inset-0 px-4 py-6 flex items-center justify-center">
            <div class="bg-white p-5 rounded-lg">
                <h2>Edit Comment</h2>
                <textarea  
                    wire:model="content"
                    class="w-full border rounded px-2 py-1 text-gray-700"></textarea>
                <button wire:click="save" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Save Changes
                </button>
                <button wire:click="closeModal" class="bg-red-400 hover:bg-red-900 text-white font-bold py-2 px-4 rounded">
                    Close
                </button>
            </div>
        </div>
    @endif

</div>



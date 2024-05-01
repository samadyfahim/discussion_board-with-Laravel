<div>
    <h1>{{ $user->name }}'s Profile</h1>
    <p>Email: {{ $user->email }}</p>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @foreach($posts as $post)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <div class="flex justify-between items-center">
                        <h3 class="mb-2 text-lg font-semibold">
                           @if(Auth::id() === $post->user_id)  <!-- Check if the logged-in user is the owner of the post -->
                            <div x-data="{ open: false }">
                                <button @click="open = !open" class="p-2 focus:outline-none focus:shadow-outline">
                                    <svg class="h-6 w-6 fill-current text-gray-600 hover:text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4zm0-10a2 2 0 100 4 2 2 0 000-4zm0 18a2 2 0 100-4 2 2 0 000 4z"/></svg>
                                </button>
                                <div x-show="open" @click.away="open = false" class="mt-2 py-2 w-48 bg-white rounded-lg shadow-xl">
                                    <div>
                                        <button wire:click="loadPost({{ $post->id }})" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                                            Edit 
                                        </button>
                                    </div>
                                    <button wire:click.prevent="deletePost({{ $post->id }})" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Delete</button>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div>
                        <p class="mb-2 text-sm text-gray-800 dark:text-gray-300">{{ $post->title }}</p>
                        <p class="mb-2 text-sm text-gray-800 dark:text-gray-300">{{ $post->content }}</p>
                    </div>

                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                    @endif
                    
                    <livewire:view-comments :post="$post" :key="'view-comments-' . $post->id" />
                    <livewire:add-comment :post="$post" :key="'add-comment-' . $post->id" />
                </div>
            </div>
        @endforeach
    <div class="mt-4 d-flex">
        @if(method_exists($posts, 'links'))
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

     @if($showModal)
        <div class="fixed inset-0 px-4 py-6 flex items-center justify-center">
            <div class="bg-white p-5 rounded-lg">
                <h2>Edit Post</h2>
                <input 
                    type="text" 
                    wire:model="title" 
                    class="w-full border rounded px-2 py-1 text-gray-700">
                <textarea  
                    wire:model="content"
                    class="w-full border rounded px-2 py-1 text-gray-700"></textarea>
            
                <div class="mb-4">
                    <label for="image" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Image:</label>
                    <input 
                        type="file" 
                        wire:model="image" 
                        id="image" 
                        class="appearance-none border rounded w-full py-2 px-3 text-sm text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            
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




    
</div>

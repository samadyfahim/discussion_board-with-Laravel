<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    @foreach($posts as $post)
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
        <div class="p-6 text-gray-900 dark:text-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="mb-2 text-lg font-semibold">
                    <a href="{{ route('profile', ['id' => $post->user->id]) }}"
                        class="text-blue-600 hover:text-blue-800">
                        {{ $post->user->name }}
                    </a>
                </h3>
                @if(Auth::id() === $post->user_id)

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
                        <button wire:click="loadPost({{ $post->id }})"
                            class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                            Edit
                        </button>
                        <button wire:click.prevent="deletePost({{ $post->id }})"
                            class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Delete</button>
                    </div>
                </div>
                @endif
            </div>
            <div>
                <p class="m-5 text-sm text-gray-800 dark:text-gray-300">{{ $post->title }}</p>
                <p class="m-5 text-sm text-gray-800 dark:text-gray-300">{{ $post->content }}</p>
            </div>

            <div class="overflow-x-auto">
                <div class="flex justify-content-center">
                    @foreach($post->images as $image)
                    <div class="m-5">
                        <img src="{{ asset('storage/' . $image->imagePath) }}" alt="{{ $post->title }}"
                            class="max-w-full h-80">
                    </div>
                    @endforeach
                </div>
            </div>

            <livewire:add-comment :post="$post" :key="'add-comment-' . $post->id" />
            <livewire:view-comments :post="$post" :key="'view-comments-' . $post->id" />
        </div>
    </div>
    @endforeach
    <div class="mt-4 d-flex">
        {{ $posts->links() }}
    </div>

    @if($showModal)
    <div class="fixed inset-0 px-4 py-6 flex items-center justify-center">
        <div class="bg-white p-5 rounded-lg">
            <h2>Edit Post</h2>
            <input type="text" wire:model="title" class="w-full border rounded px-2 py-1 text-gray-700">
            <textarea wire:model="content" class="w-full border rounded px-2 py-1 text-gray-700"></textarea>

            <div class="mb-4">
                <label for="image" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Image:</label>
                <input type="file" wire:model="image" id="image"
                    class="appearance-none border rounded w-full py-2 px-3 text-sm text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="flex justify-between">
                <button wire:click="save"
                    class=" justify-between bg-blue-500 hover:bg-green-700 text-white font-bold py-3 px-4 rounded">
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
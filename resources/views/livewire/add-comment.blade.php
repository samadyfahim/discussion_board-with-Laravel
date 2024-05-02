<div>
    @auth
    <form wire:submit.prevent="addComment">
        <div class="mt-4">
            <textarea wire:model="content" rows="1"
                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                placeholder="Enter your comment here..."></textarea>
            @error('content') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="flex justify-between">
            <div class="mb-4">
                <label for="image" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Image:</label>
                <input type="file" wire:model="image" id="image" placeholder="Add your Image"
                    class="appearance-none border rounded p-3 text-sm text-gray-600 leading-tight focus:outline-none focus:shadow-outline">
                @error('image') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-400 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Add Comment </button>
            </div>
        </div>
    </form>
    @endauth
</div>
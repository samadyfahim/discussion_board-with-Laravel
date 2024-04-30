<div>
    <form wire:submit.prevent="savePost">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Title:</label>
            <input 
                type="text" 
                wire:model="title" 
                id="title" 
                placeholder="Titel of your discussion"
                class="appearance-none border rounded w-full py-2 px-3 text-sm text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="content" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Content:</label>
            <textarea wire:model="content" id="content" rows="5" class="appearance-none border rounded w-full py-2 px-3 text-sm text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Image:</label>
            <input 
                type="file" 
                wire:model="image" 
                id="image" 
                class="appearance-none border rounded w-full py-2 px-3 text-sm text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Post</button>
        </div>
    </form>
</div>

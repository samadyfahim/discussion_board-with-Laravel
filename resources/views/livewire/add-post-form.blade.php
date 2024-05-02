<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <form wire:submit.prevent="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-5 mt-10">
            <label for="title" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Title:</label>
            <input type="text" wire:model="title" id="title" placeholder="Titel of your discussion"
                class="a w-full p-3 text-sm text-gray-600 leading-tight focus:outline-none ppearance-none border rounded focus:shadow-outline">
            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mb-5 mt-5">
            <label for="content" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Content:</label>
            <textarea wire:model="content" id="content" rows="7" placeholder="Content of your discussion"
                class=" w-full p-3 text-sm text-gray-600 appearance-none border rounded leading-tight focus:outline-none focus:shadow-outline"></textarea>
            @error('content') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Image:</label>
            <input type="file" wire:model="image" id="image" placeholder="Add your Image"
                class=" w-full py-3 text-sm text-gray-600 leading-tight focus:outline-noneappearance-none border rounded focus:shadow-outline">
        </div>
        <div class="flex items-center justify-between">
            <button type="submit"
                class="bg-blue-400 hover:bg-green-700  p-4 rounded focus:outline-none focus:shadow-outline text-white font-bold">Add
                Post</button>
        </div>
    </form>
</div>
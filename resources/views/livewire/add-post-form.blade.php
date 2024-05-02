<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <form wire:submit.prevent="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-5 mt-10">
            <label for="title" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Title:</label>
            <input type="text" wire:model="title" id="title" placeholder="Titel of your discussion"
                class="appearance-none border rounded w-full py-2 px-3 text-sm text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-5 mt-5">
            <label for="content" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Content:</label>
            <textarea wire:model="content" id="content" rows="7" placeholder="Content of your discussion"
                class="appearance-none border rounded w-full py-2 px-3 text-sm text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Image:</label>
            <input type="file" wire:model="image" id="image" placeholder="Add your Image"
                class="appearance-none border rounded w-full py-2 px-3 text-sm text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="flex items-center justify-between">
            <button type="submit"
                class="bg-blue-400 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add
                Post</button>
        </div>
    </form>
</div>
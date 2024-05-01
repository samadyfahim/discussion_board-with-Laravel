<div>
    <form wire:submit.prevent="addComment">
        <div class="mt-4">
            <textarea wire:model="content" rows="1" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Enter your comment here..."></textarea>
            @error('content') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="mt-3">
            <button type="submit" class="inline-flex">
                Add Comment
            </button>
        </div>
    </form>
</div>

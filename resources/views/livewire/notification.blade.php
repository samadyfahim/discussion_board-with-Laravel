<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    @foreach(auth()->user()->notifications as $notification)
    <div
        class="mb-1.5 mt-1 border border-gray-200 shadow-md dark:bg-gray-800 max-w-md mx-auto bg-white rounded-lg dark:border-gray-700 p-4">
        <p class="text-sm font-medium text-gray-900 dark:text-white">
            {{ $notification->data['message'] }}
        </p>
    </div>
    @endforeach
</div>
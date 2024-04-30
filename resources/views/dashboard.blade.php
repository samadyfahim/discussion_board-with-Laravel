<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach($posts as $post)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 text-gray-900 dark:text-gray-200">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                        <p class="text-sm text-gray-800 dark:text-gray-300">Posted by: {{ $post->user->name }}</p>
                    </div>

                    <p class="text-gray-800 dark:text-gray-300">{{ $post->content }}</p>7

                     <livewire:add-comment :post="$post" :key="$post->id" />

                </div>
            </div>
            @endforeach
            <div class="mt-4 d-flex">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
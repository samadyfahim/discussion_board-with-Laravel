<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <div>
            <button onclick="showViewPosts()" class="bg-gray-100 hover:bg-gray-300 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">View Posts</button>
            <button onclick="showAddPostForm()" class="bg-gray-100 hover:bg-gray-300 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Post</button>
        </div>
    </x-slot>

    <div id="viewPostsSection">
        <livewire:view-posts/>
    </div>
    <div id="addPostFormSection" style="display: none;">
        <livewire:add-post-form/>
    </div>

    <script>
        function showViewPosts() {
            document.getElementById("viewPostsSection").style.display = "block";
            document.getElementById("addPostFormSection").style.display = "none";
        }

        function showAddPostForm() {
            document.getElementById("viewPostsSection").style.display = "none";
            document.getElementById("addPostFormSection").style.display = "block";
        }
    </script>
</x-app-layout>

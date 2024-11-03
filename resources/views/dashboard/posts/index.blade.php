<x-layout-dashboard>
<!-- Main Content -->
<main class="flex-1 ml-64 bg-gray-100 p-4">
    <h1 class="text-3xl font-bold">My Posts</h1>
    
    <!-- Table Section -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">#</th>
                    <th scope="col" class="px-18 py-3">Title</th>
                    <th scope="col" class="px-12 py-3">Category</th>
                    <th scope="col" class="px-12 py-3">
                        <span class="sr-only">Actions</span>Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr class="border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $loop->iteration }}</th>
                    <td class="px-18 py-3">{{ $post->title }}</td>
                    <td class="px-12 py-3">{{ $post->category->name }}</td>
                    <td class="px-12 py-3 ">
                        <a href="/dashboard/posts/{{ $post->slug }}" class="text-blue-500 hover:text-blue-700">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                        <a href="/dashboard/posts/{{ $post->slug }}" class="text-yellow-500 hover:text-yellow-700">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <a href="/dashboard/posts/{{ $post->slug }}" class="text-red-500 hover:text-red-700">
                            <i class="fa-regular fa-circle-xmark"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

</x-layout-dashboard>
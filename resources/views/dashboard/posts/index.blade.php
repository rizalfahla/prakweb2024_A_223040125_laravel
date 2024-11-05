<x-layout-dashboard>
<!-- Main Content -->
<main class="flex-1 ml-64 bg-gray-100 p-4">
    <h1 class="text-3xl font-bold py-1">My Posts</h1>

    <div class="flex justify-center">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-2 py-1 inline-flex items-center space-x-2 mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span>{{ session('success') }}</span>
                <button type="button" class="text-green-700 font-bold ml-2" onclick="this.parentElement.style.display='none';">
                    &times;
                </button>
            </div>
        @endif
    </div>
    
    <!-- Table Section -->
    <div class="overflow-x-auto">
        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            <a href="/dashboard/posts/create">Create new post</a>
        </button>
        
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
                        <div class="flex items-center space-x-2">
                                <!-- View -->
                                <a href="/dashboard/posts/{{ $post->slug }}" class="text-blue-500 hover:text-blue-700 flex items-center">
                                <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-semibold mr-1">
                                    View <i class="fa-regular fa-eye"></i>
                                </span>
                                </a>
                                <!-- Edit -->
                                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="text-yellow-500 hover:text-yellow-700 flex items-center">
                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-semibold mr-1">
                                    Edit <i class="fa-regular fa-pen-to-square"></i>
                                </span>
                                </a>
                                <!-- Delete -->
                                <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="inline" id="deleteForm{{ $post->id }}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" onclick="showDeleteModal({{ $post->id }})" class="text-red-500 hover:text-red-700 flex items-center">
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-semibold mr-1">
                                        Delete <i class="fa-regular fa-circle-xmark"></i>
                                        </span>
                                    </button>
                                </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

</x-layout-dashboard>
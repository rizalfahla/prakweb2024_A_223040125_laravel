<x-layout-dashboard>
    <!-- Main Content -->
    <main class="flex-1 ml-64 bg-gray-100 pt-8 pb-16 lg:pt-16 lg:pb-24 dark:bg-gray-900 antialiased">
        <div class="px-4 mx-auto max-w-screen-xl">
            <article class="mx-auto w-full max-w-4xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <header class="mb-4 lg:mb-6 not-format">
                    <div class="flex items-center justify-between ">
                        <a href="/dashboard/posts" class="text-blue-600 hover:text-blue-800 font-semibold flex items-center space-x-1 pr-4">
                            <span class="text-sm">&laquo;</span>
                            <span>Back to all Posts</span>
                        </a>
                        <div class="flex space-x-3">
                            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="text-yellow-500 hover:text-yellow-700 flex items-center">
                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-semibold mr-1">
                                    Edit <i class="fa-regular fa-pen-to-square"></i>
                                </span>
                            </a>
                            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="inline" id="deleteForm{{ $post->id }}">
                                @method('delete')
                                @csrf
                                <button type="button" onclick="showDeleteModal({{ $post->id }})" class="text-red-500 hover:text-red-700 flex items-center">
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-semibold mr-1">
                                        Delete <i class="fa-regular fa-circle-xmark"></i>
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <address class="flex items-center my-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <img class="mr-4 w-16 h-16 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="{{ $post->author->name }}">
                            <div>
                                <a href="/posts?author={{ $post->author->username }}" rel="author" class="text-xl font-bold text-gray-900 dark:text-white">{{ $post->author->name }}</a>
                                <p class="text-base text-gray-500 dark:text-gray-400 mb-1">{{ $post->created_at->diffForHumans() }}</p>
                                <a href="/posts?category={{ $post->category->slug }}">
                                    <span class="bg-{{ $post->category->color }}-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                        {{ $post->category->name }}
                                    </span>
                                </a>
                            </div>
                        </div>
                    </address>

                    <!-- Display image below the category -->
                    @if($post->image)
                        <div class="mt-4 mb-6">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-auto rounded-lg">
                        </div>
                    @endif
                    
                    <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">{{ $post->title }}</h1>
                </header>
                
                <p>{{ $post->body }}</p>
            </article>
        </div>
    </main>
</x-layout-dashboard>
